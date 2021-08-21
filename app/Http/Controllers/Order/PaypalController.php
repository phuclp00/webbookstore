<?php

namespace App\Http\Controllers\Order;

use App\Events\Order\OrderComplete;
use App\Events\Order\OrderSuccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\UserAddress;
use App\Models\UserModel;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class PaypalController extends Controller
{
    public function store_order(Request $request)
    {
        try {
            $data = $request->order;
            $cart = $request->cart;
            $voucher = $request->voucher != null ? Vouchers::check($request->voucher) : null;
            DB::beginTransaction();

            if (Auth::check()) {
                $user = Auth::user();
                $shipping = $user->address()->firstOrCreate([
                    'address_line_1' => strtolower(trim(Arr::get($data, 'purchase_units.0.shipping.address.address_line_1'))),
                    'address_line_2' => strtolower(trim(Arr::get($data, 'purchase_units.0.shipping.address.address_line_2'))),
                    'wards' => null,
                    'district' => (trim(Arr::get($data, 'purchase_units.0.shipping.address.admin_area_2'))),
                    'city' => (trim(Arr::get($data, 'purchase_units.0.shipping.address.admin_area_1'))),
                    'country' => (trim(Arr::get($data, 'purchase_units.0.shipping.address.country_code'))),
                    'zip_code' => (trim(Arr::get($data, 'purchase_units.0.shipping.address.postal_code'))),
                ]);
            } else {
                $shipping = UserAddress::create([
                    'address_line_1' => Arr::get($data, 'purchase_units.0.shipping.address.address_line_1'),
                    'address_line_2' => Arr::get($data, 'purchase_units.0.shipping.address.address_line_2'),
                    'wards' => null,
                    'district' => Arr::get($data, 'purchase_units.0.shipping.address.admin_area_2'),
                    'city' => Arr::get($data, 'purchase_units.0.shipping.address.admin_area_1'),
                    'country' => Arr::get($data, 'purchase_units.0.shipping.address.country_code'),
                    'zip_code' => Arr::get($data, 'purchase_units.0.shipping.address.postal_code'),
                ]);
                $user = Guest::firstorCreate([
                    'full_name' => strtolower(trim(Arr::get($data, 'purchase_units.0.shipping.name.full_name'))),
                    'ip_address' => $request->ip(),
                    'email' => Arr::get($data, 'payer.email_address'),
                    'address_id' => $shipping->id,
                    'phone' => '4085563935',
                    'created_by' => 'Paypal gate checkout created',
                ], [
                    'user_id' => "" . now()->timestamp,
                ]);
            }
            $order = Order::create([
                'id' => Arr::get($data, 'id'),
                'shipping_id' => Shipping::where('price', $request->shipping)->first()->id,
                'payment_id' => 1,
                'delivery_adress_id' => $shipping->id,
                'status_id' => 3,
                'tax' => 0,
                'final_price' => $request->final_price,
                'voucher_id' => ($voucher != null ? ($voucher->number_of_uses > 0 ? $voucher->id : null) : null),
                'note' => "
                    Order has been payment with " . Arr::get($data, 'purchase_units.0.payments.captures.0.amount.value') . " " .
                    Arr::get($data, 'purchase_units.0.payments.captures.0.amount.currency_code') .
                    ($voucher != null ? ' and voucher ' . $voucher->code : ""),
                'created_by' => Auth::check() == false ? 'This order created by guest' : 'This order created by' . Auth::user()->user_name,
            ]);

            foreach ($cart as $value) {
                $order->books()->attach($value["book_id"], ['quantity' => $value["quantity"]]);
            }
            if ($voucher != null) {
                $voucher->number_of_uses = $voucher->number_of_uses > 1 ?  $voucher->number_of_uses - 1 : 0;
                $voucher->save();
            }
            DB::commit();
            (new OrderController)->update_sales($order);
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
}
