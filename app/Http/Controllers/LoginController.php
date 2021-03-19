<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Show_info_user;
use App\Models\UserModel;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegisted;
use App\Events\NotificationEvent;
use App\Events\UserTracker;
use App\Http\Resources\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Http\Requests\LoginRequest as RequestsLoginRequest;

class LoginController extends Controller
{
    use  HasFactory;
    use Notifiable;
    private $pathViewController = 'public.page.my-account';


    public function show_login()
    {
        return view('public.page.my-account');
    }
    public function Login(Request $request)
    {
        $result = $request->only('email', 'password');
        $option = $request->remember == "on" ? true : false;
        if (Auth::attempt([
            'email' => $result['email'],
            'password' => $result['password'],
        ], $remember = $option)) {
            $request->session()->regenerate();
            $request->session()->flash('info_success','Login Success  ! Wellcome to Bookstore !');
            return redirect()->route('home');
        } else {
            $request->session()->flash('info_warning','Login Failed  ! Please Try Again !');
        }
    }
    public function log_out()
    {
        session()->flush();
        return \redirect()->back();
    }
    public function Register(Request $request)
    {
        $data = new UserModel();
        $data_request = $request->only('username_register', 'password_register', 'email_register');
        try {
            // $data->user_name = $request->username_register;
            // $data->password = $request->password_register;
            // $data->email = $request->email_register;
            // $data->level = "user";
            // $data->status = "active";
            // $data->created_by=$data->user_name;
            // $data->save();
            //event(new UserRegisted($data));
            //$user->save();
            //Send notify to database 
            // $data->notify( new UserRegisted($data));
            //Send notify to admin 
            // event( new UserTracker($data));
            $user = UserModel::create([
                'user_name' => $data_request['username_register'],
                'password' => $data_request['password_register'],
                'email' => $data_request['email_register'],
                'created_by' => $data_request['username_register']
            ]);
            event(new UserRegisted($user));
            $request->session()->flash('logout_status', '<div class="alert alert-success">"Tạo tài khoản thành công , tiếp tục mua sắm nào !!"</div>');

            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('logout_status', '<div class="alert alert-danger">Tạo tài khoản thát bại' . $e->getMessage() . ' vui lòng thử lại</div>');
            return \redirect()->back();
        }
    }
    //Admin Account Controller 

    public function admin_auth(Request $request)
    {
        if (Auth::check("admin")) {
            return \redirect()->route("admin.dashboard");
        } else
            return \redirect()->route('admin.login.view');
    }
    public function admin_register(SignupRequest $request)
    {
        try {
            $user = new UserModel();
            $user->user_name = $request->username;
            $user->password = $request->password;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->status = "active";
            $user->save();
            $user->refresh();
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Create account ' . $request->username . ' Successfully !! </div>');
            return \redirect()->route("admin.login");
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;">  Create account ' . $request->username . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function admin_login(LoginRequest $loginRequest)
    {
        $result = $loginRequest->only('email', 'password');
        $option = $loginRequest->remember == "on" ? true : false;
        if (Auth::attempt([
            'email' => $result['email'],
            'password' => $result['password'],
            'level' => "admin"
        ], $remember = $option)) {
            $loginRequest->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } else
            $loginRequest->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;">  Login Fail,Try Again !! </div>');
        return \redirect()->back();
    }
    public function admin_logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("admin.login.view");
    }
}
