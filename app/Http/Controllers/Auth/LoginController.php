<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\UserModel;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegisted;
use App\Http\Resources\User;
use Illuminate\Notifications\Notifiable;

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
        try {
            $result = $request->only('email', 'password');
            $option = $request->remember == "on" ? true : false;
            if (Auth::guard('web')->attempt(
                [
                    'email' => $result['email'],
                    'password' => $result['password'],
                    "level" => "user"
                ],
                $remember = $option
            )) {
                $request->session()->regenerate();
                $request->session()->flash('infor_success', 'Login Success  ! Wellcome to Bookstore !');
                return redirect()->route('home');
            } else {
                $request->session()->flash('infor_warning', 'Login Failed  ! Please Try Again !');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $request->session()->flash('infor_warning', 'Login Failed  ! Please Try Again !' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function log_out(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }
    public function Register(Request $request)
    {
        $data = new UserModel();
        $data_request = $request->only('username_register', 'password_register', 'email_register');
        try {
            $user = UserModel::create([
                'user_name' => $data_request['username_register'],
                'password' => $data_request['password_register'],
                'email' => $data_request['email_register'],
                'level' => 'user',
                'status' => 1,
                'created_by' => $data_request['username_register']
            ]);
            event(new UserRegisted($user));
            $request->session()->flash('infor_success', "Your account has been created successfully !");

            return redirect()->back();
        } catch (Exception $e) {
            $request->session()->flash('infor_warning', "Can't create an account, Please try again !");
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
        if (Auth::guard("web")->attempt([
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

    // Login with google

    public function redirectToGoogleProvider()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }

    public function handleProviderGoogleCallback()
    {
        $auth_user   = Socialite::driver('google')->user();
        $user   =   UserModel::updateOrCreate(['email' => $auth_user->email], ['refresh_token'  =>  $auth_user->token, 'name'  => $auth_user->name]);
        Auth::login($user, true);
        return   redirect()->to('/');   // Redirect to a secure page 
    } 
}
