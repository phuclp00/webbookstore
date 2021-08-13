<?php

namespace App\Http\Controllers\Order;

use App\Events\Order\OrderCancel;
use App\Events\Order\OrderComplete;
use App\Events\Order\OrderRestore;
use App\Events\Order\OrderSuccess;
use App\Events\Order\StatusUpdate;
use App\Events\Request\RequestCancelOrder;
use App\Models\Guest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use App\Mail\OrderStatusUpdate;
use App\Models\OrderStatus;
use App\Models\Shipping;
use App\Models\UserAddress;
use App\Models\UserModel;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function show($id)
    {
        $data = Order::find($id);
        if ($data != null) {
            return \response([
                'status' => 'success',
                'data' => $data->load('vouchers', 'status', 'books', 'payment'),
            ]);
        } else {
            return \response([
                'status' => 'danger',
                'mess' => 'Không tìm thấy đơn hàng với mã là :' . $id
            ]);
        }
    }
    public function update_sales($order)
    {
        $data = new Collection();
        $total = 0;
        $sales_total = 0;
        //Update book
        foreach ($order->books as $book) {
            $total = $book->pivot->quantity;
            Redis::INCRBY('product:' . $book->book_id . ':sales', $total);
            $book->total = $book->total - $total;
            $book->save();
        }

        //Update order
        $orders = Order::all();
        foreach ($orders as $value) {
            foreach ($value->books as $item) {
                $data[] = $item;
            }
        }
        $group = $data->groupBy('book_id');
        foreach ($group as $order) {
            foreach ($order as $book) {
                $sales_total += $book->pivot->quantity;
            }
        }
        return Redis::set('orders:sales:total', $sales_total);
    }
    public function store(Request $request)
    {
        try {
            $cart = $request->cart;
            $voucher = $request->voucher != null ? Vouchers::check($request->voucher) : null;
            DB::beginTransaction();
            if (Auth::check()) {
                $user = Auth::user();
                $shipping = UserAddress::firstorCreate([
                    'user_id' => Auth::user()->user_id,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'wards' => $str = ltrim(($request->wards), '0'),
                    'district' => ltrim($request->district, '0'),
                    'city' => ltrim($request->city, '0'),
                    'country' => "VN",
                    'zip_code' => $request->zipcode,
                ]);
            } else {
                $shipping = UserAddress::create([
                    'user_id' => null,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'wards' => $str = ltrim(($request->wards), '0'),
                    'district' => ltrim($request->district, '0'),
                    'city' => ltrim($request->city, '0'),
                    'country' => "VN",
                    'zip_code' => $request->zipcode,
                ]);
                $user = Guest::create([
                    'user_id' => "" . now()->timestamp,
                    'full_name' => $request->fullname,
                    'ip_address' => $request->ip(),
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address_id' => $shipping->id,
                    'created_by' => 'Khách vãng lai',
                ]);
            }
            $order = Order::create([
                'id' => 'BAH' . Str::random(14),
                'shipping_id' => Shipping::where('price', $request->shipping)->first()->id,
                'payment_id' => 2,
                'delivery_adress_id' => $shipping->id,
                'status_id' => 2,
                'tax' => 0,
                'final_price' => $request->final_price,
                'voucher_id' => ($voucher != null ? ($voucher->number_of_uses > 0 ? $voucher->id : null) : null),
                'note' => $request->note,
                'created_by' => Auth::check() == false ? 'This order created by guest' : 'This order created by' . Auth::user()->user_name,
            ]);
            foreach ($cart as $value) {
                $order->books()->attach($value["book_id"], ['quantity' => $value["quantity"]]);
            }
            if ($voucher != null) {
                $voucher->number_of_uses = $voucher->number_of_uses > 1 ?  $voucher->number_of_uses - 1 : 0;
                $voucher->save();
            }
            $this->update_sales($order);
            DB::commit();
            \event(new OrderSuccess($order, $user->email));
            return \response([
                'status' => 'success',
                'mess' => 'Đặt Hàng Thành Công ! Mã Đơn Hàng Của Bạn Là :' . $order->id,
                'order' => $order->id
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return \response([
                'status' => 'danger',
                'mess' => 'Đặt Hàng Thất Bại ! Vui Lòng Liên Hệ Quản Trị Viê hoặc Nhân Viên CSKH để được tư vấn' . $th->getMessage(),
            ]);
        }
    }
    public function destroy($id, $email)
    {
        try {
            DB::beginTransaction();
            $order = Order::find($id);
            $order->deleted_by = Auth::user()->user_name;
            $order->save();
            $order->delete();
            $user = UserModel::where('email', $email)->first();
            if ($user == null) {
                $user = Guest::where('email', $email)->first();
            }
            DB::commit();
            \event(new OrderCancel($order, $user));
            return \response([
                'status' => 'success',
                'mess' => 'The order' . $order->id . ' has been canceled !'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response([
                'status' => 'danger',
                'mess' => 'Canceled order was failled with message' . $th->getMessage()
            ]);
        }
    }
    public function request_cancel(Request $request)
    {
        $order = Order::find($request->id);
        if ($order) {
            event(new RequestCancelOrder($order, $request->mess));
            return \response([
                'status' => 'success',
                'mess' => 'Yêu cầu được gửi thành công !'
            ]);
        } else
            return \response([
                'status' => 'danger',
                'mess' => 'Mã đơn hàng không hợp lệ !'
            ]);
    }
    public function summary(Request $request)
    {
        $order = Order::find($request->order_id)->load('address.get_districts', 'address.get_wards', 'address.get_city', 'address.user.phone', 'address.guest');
        $phone = Auth::check() ? $order->address->user->phone[0]->number : $order->address->guest[0]->phone;
        $order->address->guest;
        return view('client.sections.static.order_sumary', ['order' => $order, 'phone' => $phone]);
    }
    //Admin
    public function show_order(Request $request)
    {
        try {
            $orderlist = [];
            $data = UserModel::withTrashed()->find($request->id);
            $address = $data->address()->withTrashed()->get();
            foreach ($address as $value) {
                if ($value->orders->count() > 0)
                    $orderlist = new Collection($value->orders->load('vouchers', 'shipping', 'status', 'payment'));
            }
            return \response([
                'status' => 'success',
                'data' => $orderlist,
                'mess' => 'Loading orders list success'
            ]);
        } catch (\Throwable $th) {
            return \response([
                'status' => 'danger',
                'mess' => 'Loading orders list failed with' . $th->getMessage()
            ]);
        }
    }
    public function show_guest_order(Request $request)
    {
        $data = Guest::find($request->id)->load('address.orders.vouchers', 'address.orders.shipping', 'address.orders.payment', 'address.orders.status');
        return \response([
            'status' => 'success',
            'data' => ($data->address->orders),
            'mess' => 'Loading orders list success'
        ]);
    }
    public function order_guest_list()
    {
        $orderlist = new Collection();
        $check = Order::withTrashed()->get();
        $orders = $check->filter(function ($data) {
            return $data->address->user_id == null;
        });
        foreach ($orders as  $order) {
            $orderlist[] = [
                'order' => $order->load(
                    'vouchers',
                    'status',
                    'shipping',
                    'payment',
                    'books',
                    'address.get_districts',
                    'address.get_wards',
                    'address.get_city',
                ),
                'user' => $order->address->guest[0]
            ];
        }
        return ($orderlist);
    }
    public function order_user_list()
    {
        $orderlist = new Collection();
        $check = Order::withTrashed()->get();
        $orders = $check->filter(function ($data) {
            return $data->address->user_id != null;
        });
        foreach ($orders as  $order) {
            $orderlist[] = [
                'order' => $order->load(
                    'vouchers',
                    'status',
                    'shipping',
                    'payment',
                    'books',
                    'address.get_districts',
                    'address.get_wards',
                    'address.get_city',
                ),
                'user' => $order->address->user->load('phone')
            ];
        }
        return ($orderlist);
    }
    public function update_status(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::find($request->order["id"]);
            $order->status_id = $request->id + 1;
            $order->modified_by = Auth::user()->user_name;
            $order->save();
            $user = UserModel::where('email', $request->email)->first();
            if ($user == null) {
                $user = Guest::where('email', $request->email)->first();
            }
            DB::commit();
            if ($order->status_id == OrderStatus::all()->last()->id) {
                event(new OrderComplete($order, $user));
            } else {
                event(new StatusUpdate($order, $user));
            }
            return \response([
                'status' => 'success',
                'data' => $order->status,
                'mess' => 'Update order status success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response([
                'status' => 'danger',
                'mess' => 'Update order status has failed with error ' . $th->getMessage()
            ]);
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Order::withTrashed()->find($request->order);
            $data->restore();
            $data->modified_by = Auth::user()->user_name;
            $data->save();
            DB::commit();
            \event(new OrderRestore($data, $request->email));
            return \response([
                'status' => 'success',
                'mess' => 'Restore order ' . $request->order . ' successfully !'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response([
                'status' => 'success',
                'mess' => 'Restore order' . $request->order . 'was failed with error ' . $th->getMessage()
            ]);
        }
    }
}
