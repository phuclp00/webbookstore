<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserModel;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Cached\Storage\Memcached;
use DB;
use Illuminate\Cache\Repository;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserController extends Controller
{

    public function index(Request $request){
        $users = UserModel::with('user_detail')->get();
        return $users;
    }   
    public function account_view(Request $request)
    {
        if (session()->has('user_info')) {
            $key_find = $request->user_name;
            $data = UserModel::with('user_detail')->where('user_name', $key_find)->first();
            if ($data->street != null || $data->phone != null) {
                session()->flash('account_info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;">
                Xin chào  ' . $data->user_name . '</div>');
            } else {
                session()->flash('account_info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"">
                    Hãy cập nhật thông tin của bạn để dễ dàng thanh toán hơn </div>');
            }
            return view('public.page.account-info')->with('data', $data);
        } else {
            return \redirect('/');
        }
    }
    public function notifications()
    {
        return auth()->user()->unreadNotifications->limit(5)->get()->toArray();
    }
    public function update_img(Request $request)
    {
        $request->validate([
            'upload_file' => 'required',
        ]);
        try {
            $file = $request->upload_file;
            $data = UserDetail::find($request->user_id);
            $data->img = $file->getClientOriginalName();
            $data->save();
            $path = $file->storeAs('user_profile', $file->getClientOriginalName(), 'images');
            //Update lai thong tin nguoi dung 
            \session()->forget('user_info');
            $show_info =UserModel::with('user_detail')->find($data->user_id)->first();
            \session()->push('user_info', $show_info);
            $data->refresh();
            return \redirect()->back();
        } catch (Exception $e) {
            session()->flash('account_info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"">
                  Cập nhật ảnh thất bại </div>');
        }
    }
    public function account_update(Request $request)
    {
        
        $key_find = $request->user_id;
        dd($key_find);
        $data_user = UserModel::find($key_find)->first();
        $data_account =  UserModel::with('user_detail')->find($key_find)->first();
        try {
            if ($request->email_register != $data_user->email && $request->email_register != "") {
                $data_account->email = $request->email_register;

                $data_account->save();

                $data_account->refresh();
            }
            if ($request->password_register != "11111122333") {
                if ($request->password_register == $request->re_password) {
                    $new_pass = $request->password_register;
                    $data_account->password = $new_pass;
                    $data_account->save();
                    $data_account->refresh();
                    $request->session()->flash('update_info', '<div class="alert alert-success">"Cập nhật mật khẩu thành công !!!"</div>');
                    return \redirect()->route('account_view', [$data_account->user_name]);
                }
            }
            $data_account->full_name = $request->fullname;
            $data_account->phone = $request->phone;
            $data_account->street = $request->street;
            $data_account->district = $request->district;
            $data_account->city = $request->city;
            $data_account->save();

            $request->session()->flash('update_info', '<div class="alert alert-success">"Cập nhật khoản thành công , tiếp tục mua sắm nào !!"</div>');
            return \redirect()->route('account_view', [$data_account->user_name]);
        } catch (Exception $e) {

            $request->session()->flash('update_info', '<div class="alert alert-danger">"Cập nhật tài khoản thất bại, vui lòng thử lại!!"</div>');
            return \redirect()->route('account_view', [$data_account->user_name]);
        }
    }
    public function delete_user(Request $request)
    {
        try {
            UserModel::where('user_name', $request->user_name)->delete();
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete' . $request->user_id . ' Successfully !! </div>');
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->user_id . ' Fail,Try Again !!</div>');
        }
        return \redirect()->back();
    }
    public function search_user(Request $request)
    {
        $output = "";
        $key_find = $request->search_user;
        if ($key_find != " ") {
            try {
                $list_search = UserModel::with('user_detail')->where('level', '=', $key_find)
                    ->orwhere('user_name', 'like', '%' . $key_find . '%')
                    ->orWhere('full_name', 'like', '%' . $key_find . '%')
                    ->orwhere('status', '=', $key_find)
                    ->get();
                if ($list_search != "") {
                    foreach ($list_search as $data => $user) {
                        $output .= "<tr id='show_user_list'>
                       <td class='text-center'><img class='rounded img-fluid avatar-40'
                             src='../images/users/$user->user_id/$user->img' alt='profile'></td>
                       <td>$user->user_name</td>
                       <td>$user->full_name</td>
                       <td><a href='https://iqonic.design/cdn-cgi/l/email-protection' class='__cf_email__'
                             data-cfemail='$user->email'>[email&#160;protected]</a>
                       </td>
                       <td>$user->street-$user->district-$user->city</td>
                       <td>$user->phone</td>";
                        if ($user->level == 'admin')
                            $output .= "<td><span class='badge iq-bg-warning'>$user->level</span></td>";
                        else
                            $output .= "<td><span class='badge iq-bg-info'>$user->level</span></td>";
                        if ($user->status == 'ban')
                            $output .= "<td><span class='badge iq-bg-danger'>$user->status</span></td>";
                        else
                            $output .= "<td><span class='badge iq-bg-primary'>$user->status</span></td>";
                        $output .= "
                       <td>$user->created</td>
                       <td>
                          <div class='flex align-items-center list-user-action'>
                             <a class='iq-bg-primary' data-toggle='tooltip' data-placement='top' title=''
                                data-original-title='Add' href='#'><i class='ri-user-add-line'></i></a>
                             <a class='iq-bg-primary' data-toggle='tooltip' data-placement='top' title=''
                                data-original-title='Edit' href='#'><i class='ri-pencil-line'></i></a>
                             <a class='iq-bg-primary' data-toggle='tooltip' data-placement='top' title=''
                                data-original-title='Delete' href='" . route('admin_delete_user', [$user->user_name]) . "'><i class='ri-delete-bin-line'></i></a>
                          </div>
                       </td>
                    </tr>";
                    }
                } else {
                    $output = '
                        <tr>
                            <td align="center" colspan="5">No Data Found</td>
                        </tr>
                        ';
                }
                $data = array(
                    'result' => $output
                );
                return \json_encode($data);
            } catch (Exception $e) {
                \report($e);
            }
        } else {
            $data = null;
            return $data;
        }
    }
    public function update_status(Request $request)
    {
            $user_id=$request->userid;
            $status=$request->status;
            $result = UserModel::find($user_id)->update('status', ($status=="active"?"ban":"active"))->with('user_detail');
        return \response($result);
    }
    public function get_list_notify()
    {
        try {
            $data = Notifications::with('usermodel')->paginate(10);
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
            Notifications::find($notify_id)->update(['read_at' => now()]);
            return response(['message' => 'done', 'notifications' => $user->notifications]);
        } catch (Exception $e) {
            \report($e);
        }
    }
}