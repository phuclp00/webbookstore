<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Store\FileuploadController;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserModel::with('user_detail')->get();
        return $users;
    }
    public function account_view(Request $request)
    {
        $key_find = Auth::user()->user_id;
        if (Auth::check()) {
            $data = UserModel::find($key_find)->load('user_detail');
            if ($data->user_detail->street != null || $data->user_detail->phone != null) {
                session()->flash('info_success', "Have a good day " . $data->user_name . "! We're glad you're here !");
            } else {
                session()->flash('infor_warning', "Looks like you haven't updated your payment information yet! Please update for easier payment!");
            }
            return view('public.page.account-info', ['data' => $data]);
        } else {
            return redirect()->route('home');
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
        $key_find = Auth::user()->user_id;
        $data_account =  UserModel::find($key_find)->load('user_detail')->first();
        try {
            if ($request->email_register != $data_account->email && $request->email_register != "") {
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
                    $request->session()->flash('infor_success', "Your password has been successfully updated!");
                    return \redirect()->back();
                }
            }
            $data_account->user_detail->full_name = $request->fullname;
            $data_account->user_detail->phone = $request->phone;
            $data_account->user_detail->street = $request->street;
            $data_account->user_detail->district = $request->district;
            $data_account->user_detail->city = $request->city;
            $data_account->user_detail->save();
            $data_account->save();

            $request->session()->flash('infor_success', "Your account has been successfully updated!");
            return \redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('infor_warning', '<div class="alert alert-danger">"Your account update failed! Please try again !"</div>');
            return \redirect()->back();
        }
    }
    public function delete_user(Request $request)
    {
        try {
            $file = new FileuploadController();
            $user = UserModel::where('user_name', $request->user_name)->delete();
            $file->destroy("images", "user_profile", "$user->img");
            $request->session()->flash('infor_success', 'Delete user' . $request->user_id . ' Successfully !');
        } catch (Exception $e) {
            $request->session()->flash('infor_warning', "Delete ' . $request->user_id . ' Fail,Try Again !");
        }
        return \redirect()->back();
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
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
