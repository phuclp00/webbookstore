<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendEmailContact;
use App\Events\User\UserPasswrodReset;
use App\Http\Controllers\Store\FileuploadController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use App\Models\Guest;
use App\Models\Notifications;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserPhone;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\MockObject\DuplicateMethodException;
use Throwable;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return $this->user;
    }
    public function send_email(Request $request)
    {
        try {
            $name = strip_tags($request->name);
            $email = strip_tags($request->email);
            $phone = strip_tags($request->phone);
            $mess = strip_tags($request->mess);
            \event(new SendEmailContact($name, $email, $mess, $phone));
            return \response(['status' => 'success', 'mess' => 'Cảm ơn ban đã gửi email cho chúng tôi ! Chúng tôi sẽ liên hệ lại với bạn sớm nhất']);
        } catch (\Throwable $th) {
            return \response(['status' => 'danger', 'mess' => 'Gửi email thất bại, hệ thống đang tạm thời dừng tính năng này !' . $th->getMessage()]);
        }
    }
    public function account_view(Request $request)
    {
        return view('client.sections.user.my-account');
    }
    public function order_create_account(Request $request)
    {
        try {
            if (UserModel::where('email', $request->email)->first()) {
                return response([
                    'status' => 'danger',
                    'mess' => 'Tạo tài khoản thất bại, email đã được đăng ký! Thông tin đơn hàng sẽ được gửi vào email của bạn',
                ]);
            }
            DB::beginTransaction();
            $user = UserModel::create([
                'email' => $request->email,
                'user_name' => $request->email,
                'password' => $request->password == null ? "booksto1234" : $request->password,
                'refresh_token' => Str::random(60),
                'level' => 'user'
            ]);
            $user->address()->create([
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'district' => $request->district,
                'wards' => $request->wards,
                'city' => $request->city,
                'zip_code' => $request->zipcode,
                'created_by' => 'Created by Account Order from checkout order'
            ]);
            $user->phone()->create([
                'number' => $request->phone
            ]);
            DB::commit();
            return response([
                'status' => 'success',
                'mess' => 'Tạo tài khoản thành công! Thông tin tài khoản và mật khẩu đã được gửi vào email của bạn',
            ]);
        } catch (Throwable $th) {
            DB::rollback();
            return response([
                'status' => 'danger',
                'mess' => 'Tạo tài khoản thất bại ! Liên Hệ bộ phận CSKH để biết thêm chi tiết' . $th->getMessage(),
            ]);
        }
    }
    public function set_default_phone(Request $request)
    {
        try {
            DB::beginTransaction();
            $phone = Auth::user()->phone;
            $temp = $phone[0]->number;
            foreach ($phone as $key => $value) {
                if ($value->number == $request->number) {
                    $phone[0]->number = $request->number;
                    $phone[0]->save();
                    $phone[$key]->number = $temp;
                    $phone[$key]->save();
                    DB::commit();
                    return \response(['status' => 'success', 'mess' => 'Đặt số điện thoại mặc định thành công!']);
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return \response(['status' => 'danger', 'mess' => 'Đặt làm số điện thoại thất bại!' . $th->getMessage()]);
        }
    }
    public function notifications()
    {
        return auth()->user()->unreadNotifications->limit(5)->get()->toArray();
    }
    public function update_password(Request $request)
    {
        if ($request->token != Auth::user()->refresh_token) {
            return \response(['status' => 'danger', 'mess' => 'Bạn không có quyển truy cập vào đây !']);
        }
        $user =  UserModel::where('refresh_token', $request->token)->first();
        if (Hash::check($request->password, $user->password)) {
            try {
                DB::beginTransaction();
                $user->password = $request->new_password;
                $user->status = 0;
                $user->save();
                DB::commit();
                return \response(['status' => 'success', 'mess' => 'Thay đổi mật khẩu thành công !']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return \response(['status' => 'danger', 'mess' => 'Thay đổi mật khẩu thất bại !']);
            }
        }
        return \response(['status' => 'danger', 'mess' => 'Sai mật khẩu !']);
    }
    public function address_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $old = UserAddress::find($request->id)->load('get_wards', 'get_city', 'get_districts');
            if ($old->orders()->exists()) {
                $new = $old->replicate();
                $new->address_line_1 = $request->address_line_1;
                $new->address_line_2 = $request->address_line_2;
                $new->wards = $request->wards;
                $new->district = $request->district;
                $new->city = $request->city;
                $new->zip_code = $request->zipcode;
                $new->modiffed_by = "User " . $old->user->user_name;
                $new->save();
                $old->deleted_by = "User " . $old->user->user_name;
                $old->delete();
            } else {
                $old->address_line_1 = $request->address_line_1;
                $old->address_line_2 = $request->address_line_2;
                $old->wards = $request->wards;
                $old->district = $request->district;
                $old->city = $request->city;
                $old->modiffed_by = "User " . $old->user->user_name;
                $old->zip_code = $request->zipcode;
                $old->save();
            }
            $data = UserAddress::where('user_id', $old->user_id)->with('get_wards', 'get_city', 'get_districts')->get();
            DB::commit();
            return \response(['status' => 'success', 'data' => $data, 'mess' => 'Cập nhật địa chỉ thành công !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Cập nhật địa chỉ thất bại ! Liên hệ bộ phận CSKH để biết thêm chi tiết !']);
        }
    }
    public function address_add(Request $request)
    {
        try {
            DB::beginTransaction();
            $old = Auth::user()->load(['address' => function ($query) {
                $query->withTrashed();
            }]);
            $new = UserAddress::create([
                "address_line_1" => strtolower(trim($request->address_line_1)),
                "address_line_2" => strtolower(trim($request->address_line_2)),
                "user_id" => Auth::user()->user_id,
                "wards" => $request->wards,
                "district" => $request->district,
                "city" => $request->city,
                "zip_code" => $request->zipcode
            ]);
            //Check duplicate
            foreach ($old->address as $value) {
                if (
                    $value->address_line_1 == $new->address_line_1 &&
                    $value->address_line_2 == $new->address_line_2 &&
                    $value->wards == $new->wards &&
                    $value->district == $new->district &&
                    $value->city == $new->city &&
                    $value->zip_code == $new->zip_code
                ) {
                    if ($value->deleted_at) {
                        DB::rollBack();
                        $value->restore();
                        DB::commit();
                        $data = UserAddress::where('user_id', Auth::user()->user_id)->with('get_wards', 'get_city', 'get_districts')->get();
                        return \response(['status' => 'success', 'data' => $data, 'mess' => 'Thêm địa chỉ thành công !Tuy nhiên trông có vẻ như bạn đã từng xóa địa chỉ này trước đây và chúng tôi đã khôi phục lại cho bạn !']);
                    } else {
                        DB::rollBack();
                        return \response(['status' => 'danger', 'mess' => 'Thêm địa chỉ thất bại ! Trông có vẻ như bạn đã có địa chỉ này trong hệ thống!']);
                    }
                }
            }
            $data = UserAddress::where('user_id', Auth::user()->user_id)->with('get_wards', 'get_city', 'get_districts')->get();
            DB::commit();
            return \response(['status' => 'success', 'data' => $data, 'mess' => 'Thêm địa chỉ thành công !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Thêm địa chỉ thất bại ! Liên hệ bộ phận CSKH để biết thêm chi tiết !' . $th->getMessage()]);
        }
    }
    public function address_delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $address = UserAddress::find($request->id);
            if ($address->orders()->exists()) {
                $address->deleted_by = "User " . Auth::user()->username;
                $address->save();
                $address->delete();
            } else {
                $address->forceDelete();
            }
            $data = Auth::user()->address->load('get_wards', 'get_city', 'get_districts');
            DB::commit();
            return \response(['status' => 'success', 'data' => $data, 'mess' => 'Xóa địa chỉ thành công !']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Xóa địa chỉ thất bại ! Liên hệ bộ phận CSKH để biết thêm chi tiết !']);
        }
    }
    public function update_img(Request $request)
    {
        $request->validate([
            'upload_file' => 'required',
        ]);
        try {
            $file = $request->upload_file;
            $userId = Auth::user()->user_id;
            $data = UserModel::find($userId)->load('user_detail');
            $data->user_detail->img = $file->getClientOriginalName();
            $data->modified_by = Auth::user()->user_name;
            $data->user_detail->modified_by = Auth::user()->user_name;
            $data->user_detail->save();
            $data->save();
            $path = $file->storeAs('user_profile', $file->getClientOriginalName(), 'images');
            $data->refresh();
            session()->flash('infor_success', 'Your image has been successfully updated !');
            return \redirect()->back();
        } catch (Exception $e) {
            session()->flash('infor_warning', $e->getMessage());
            return \redirect()->back();
        }
    }
    public function account_update(Request $request)
    {
        try {
            DB::beginTransaction();
            if (Auth::user()->refresh_token != $request->token) {
                return \response(['status' => 'danger', 'mess' => 'Bạn không có quyển cập nhật tài khoản này  !']);
            }
            $user = Auth::user();
            if ($request->name != "") {
                $user->user_name = $request->name;
                $user->save();
            }
            if ($request->email != "")
                $user->email = $request->email;
            $user->save();
            if ($request->current_phone != "") {
                $data = UserPhone::where('number', $request->phone)->first();
                $data->number = $request->current_phone;
                $data->save();
            }
            if ($request->new_phone != "") {
                $check_phone = UserPhone::where('number', $request->new_phone)->first();
                if ($check_phone) {
                    return \response(['status' => 'danger', 'mess' => 'Cập nhật tài khoản thất bại ! Số điện thoại đã tồn tại trong hệ thống !']);
                }
                $user->phone()->create(['number' => $request->new_phone]);
                $user->modified_by = Auth::user()->user_name;
                $user->push();
                $user->save();
            }
            DB::commit();
            return \response(['status' => 'success', 'mess' => 'Cập nhật tài khoản thành công!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Cập nhật tài khoản thất bại !' . $th->getMessage()]);
        }
    }
    public function phone_delete($number)
    {
        $user = Auth::user();
        if ($user) {
            foreach ($user->phone as $phone) {
                if ($phone->number == $number) {
                    $phone->delete();
                    return \response(['status' => 'success', 'mess' => 'Xóa số điện thoại thành công !']);
                }
            }
            return \response(['status' => 'danger', 'mess' => 'Xóa số điện thoại thất bại, có vẻ như trong tài khoản của bạn không có số này !']);
        }
    }
    public function delete_user($id)
    {
        try {
            DB::beginTransaction();

            $user = UserModel::find($id);
            $data = UserModel::where('level', 'user')->get()->load(
                'address.get_city',
                'address.get_wards',
                'address.get_districts',
                'phone'
            );
            if ($user == null) {
                return \response(['status' => 'danger', 'mess' => "Deleted user was failed with error : Can't find this user!  "]);
            }
            if ($user->address()->exists() == false && $user->phone()->exists() == false && $user->rating()->exists() == false) {
                $user->forceDelete();
                DB::commit();
                return \response(['status' => 'success', 'data' => $data, 'mess' => 'Deleted user success !']);
            } else {
                $user->deleted_by = Auth::user()->user_name;
                $user->save();
                $user->delete();
                DB::commit();
                return \response(['status' => 'success', 'data' => $data, 'mess' => 'Account has been disabled !']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Deleted user was failed with error !' . $th->getMessage()]);
        }
    }
    public function delete_guest($id)
    {
        try {
            DB::beginTransaction();
            $user = Guest::find($id);
            if ($user == null) {
                return \response(['status' => 'danger', 'mess' => "Deleted guest was failed with error : Can't find this guest!  "]);
            }
            $user->deleted_by = Auth::user()->user_name;
            $user->save();
            $user->delete();
            DB::commit();
            $guest = Guest::all()->load('address.get_city', 'address.get_wards', 'address.get_districts');

            return \response(['status' => 'success', 'data' => $guest, 'mess' => 'Deleted guest success !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Deleted guest was failed with error !' . $th->getMessage()]);
        }
    }
    public function update_status(Request $request)
    {
        try {
            $user_id = $request->userid;
            $status = $request->status;
            $result = UserModel::find($user_id);
            $result->status = ($status == 1 ? 0 : 1);
            $result->save();
            $data = UserModel::with('user_detail')->get();
            return \response($data);
        } catch (Exception $e) {
            \report($e);
        }
    }
    public function restore_guest(Request $reqeust)
    {
        try {
            DB::beginTransaction();
            $user = Guest::withTrashed()->find($reqeust->id);
            if ($user == null) {
                return \response(['status' => 'danger', 'mess' => "Restore guest was failed with error : Can't find this guest! "]);
            }
            $user->modified_by = Auth::user()->user_name;
            $user->save();
            $user->restore();
            DB::commit();
            $guest = Guest::onlyTrashed()->with('address.get_city', 'address.get_wards', 'address.get_districts')->get();

            return \response(['status' => 'success', 'data' => $guest, 'mess' => 'Restore guest success !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Restore guest was failed with error !' . $th->getMessage()]);
        }
    }
    public function restore_user(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = UserModel::onlyTrashed()->find($request->id);
            if ($user == null) {
                return \response(['status' => 'danger', 'mess' => "Restore user was failed with error : Can't find this user!  "]);
            }
            $user->deleted_by = Auth::user()->user_name;
            $user->save();
            $user->restore();
            DB::commit();
            $data = UserModel::onlyTrashed()->where('level', 'user')->with(
                'address.get_city',
                'address.get_wards',
                'address.get_districts',
                'phone'
            )->get();
            return \response(['status' => 'success', 'data' => $data, 'mess' => 'Restore user success !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'mess' => 'Restore user was failed with error !' . $th->getMessage()]);
        }
    }
    public function get_list_notify()
    {
        try {

            $data = Auth::user()->notifications;
            return $data;
        } catch (Exception $e) {
            \report($e);
        }
    }
    public function get_id_notify(Request $request)
    {
        try {
            $id = $request->id;
            $data = Notifications::find($id)->get();
            return $data;
        } catch (Exception $e) {
            \report($e);
        }
    }
    public function markAsRead(Request $request)
    {
        $notify_id = $request->notifyId;
        $user_id = $request->userId;
        try {
            $user = UserModel::find($user_id);
            $user->unreadNotifications()->where('id', $notify_id)->update(['read_at' => now()]);
            return response(['message' => 'done', 'notifications' => $user->notifications]);
        } catch (Exception $e) {
            \report($e);
        }
    }
    public function get_address_list(Request $request)
    {
        $data = UserModel::where('refresh_token', $request->user_token)->first();
        if ($data) {
            return response([
                'status' => 'success',
                'address' => \json_decode($data->address),
                'mess' => 'Tải danh sách địa chỉ giao hàng thành công !',
            ]);
        }
        return response([
            'status' => 'info',
            'address' => $data->address,
            'mess' => 'Tải dữ liệu địa chỉ giao hàng của tôi thất bại, không tìm thấy trong danh sách đã lưu',
        ]);
    }
    public function get_phone_list(Request $request)
    {
        $data = UserModel::where('refresh_token', $request->user_token)->first();
        if ($data) {
            return response([
                'status' => 'success',
                'data' => $data->phone,
                'mess' => 'Tải danh sách điện thoại thành công !',
            ]);
        }
        return response([
            'status' => 'danger',
            'mess' => 'Tải dữ liệu điện thoại của tôi thất bại, không tìm thấy trong danh sách đã lưu',
        ]);
    }
    public function show_my_address(Request $request)
    {
        $district = District::find($request->district) != null ? District::find($request->district)->name : $request->district;
        $wards = Ward::find($request->wards) != null ? Ward::find($request->wards)->name : $request->wards;
        $city = Province::find($request->city) != null ? Province::find($request->city)->name : $request->city;
        return ("- phường/xã:" . $wards . " - quận/huyện: " . $district . "- tỉnh/thành phố: " . $city);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    public function reset_password(Request $request)
    {
        try {
            $user = UserModel::where('email', $request->email)->first();
            $user->password = "booksto1234";
            $user->save();
            \event(new UserPasswrodReset($user));
            return \response(['status' => 'success', 'mess' => 'Reset password success !']);
        } catch (\Throwable $th) {
            return \response(['status' => 'danger', 'mess' => 'Reset password failed with error :' . $th->getMessage() . ' !']);
        }
    }
    public function add_favorite(Request $request)
    {
        if (Auth::check()) {
            try {
                foreach (Auth::user()->favorite as  $value) {
                    if ($request->item["book_id"] == $value->book_id) {
                        return \response(['status' => 'danger', 'mess' => 'Thêm vào danh sách yêu thích thất bại ! Bạn đã có sản phẩm này trong danh sách yêu thích']);
                    }
                }
                DB::beginTransaction();
                $data = Auth::user()->favorite()->attach($request->item["book_id"]);
                DB::commit();
                return \response(['status' => 'success', 'mess' => 'Thêm vào danh sách yêu thích thành công']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return \response(['status' => 'danger', 'mess' => 'Thêm vào danh sách yêu thích thất bại !' . $th->getMessage()]);
            }
        } else {
            return \response(['status' => 'danger', 'mess' => 'Thêm vào danh sách yêu thích thất bại !Bạn cần đăng nhập tài khoản để thực hiện tính năng này']);
        }
    }
    public function show_favorite()
    {
        $data = Auth::user()->favorite;
        if ($data) {
            return \response(['status' => 'success', 'data' => $data]);
        } else {
            return \response(['status' => 'danger', 'data' => [], 'mess' => 'Bạn không có sản phẩm nào trong danh sách yêu thích ']);
        }
    }
    public function sync_favorite(Request $request)
    {
        try {
            DB::beginTransaction();
            $list_favorite = $request->item;
            $key = [];
            foreach ($list_favorite as $value) {
                $key[] = $value["book_id"];
            }
            Auth::user()->favorite()->sync($key);
            DB::commit();
            $list = Auth::user()->favorite;
            return \response(['status' => 'success', 'data' => $list, 'mess' => 'Cập nhật danh sách yêu thích thành công !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response(['status' => 'danger', 'data' => [], 'mess' => 'Cập nhật thất bại ' . $th->getMessage()]);
        }
    }
    public function total_money_used()
    {
        $user = Auth::user()->load(['address' => function ($query) {
            $query->withTrashed();
        }]);
        $money = 0;
        if ($user) {
            foreach ($user->address as $address) {
                if ($address->orders->count() > 0)
                    foreach ($address->orders as $order) {
                        if ($order->status->percent == 100) {
                            $money += $order->final_price;
                        }
                    }
            }
        }
        return \response(['user' => $user->user_name, 'total_used' => $money]);
    }
    //Admin
    public function show(Request $request)
    {
        return UserModel::withTrashed()->where('email', $request->user)->with('membership')->first();
    }
}
