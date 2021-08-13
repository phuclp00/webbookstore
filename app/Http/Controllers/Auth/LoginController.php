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
use App\Events\User\UserRegisted;
use App\Http\Resources\User;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use  HasFactory;
    use Notifiable;
    private $pathViewController = 'public.page.my-account';
    public function show_login()
    {
        return view('client.sections.user.login-register');
    }
    public function login(Request $request)
    {
        try {
            $result = $request->only('email', 'password');
            $option = $request->remember == "on" ? true : false;

            if (Auth::attempt(
                [
                    'email' => $result['email'],
                    'password' => $result['password'],
                    "level" => "user"
                ],
                $remember = $option
            )) {
                $request->session()->regenerate();
                Auth::user()->status = 1;
                Auth::user()->save();
                return \response()->json([
                    'status' => 'success',
                    'mess' => 'Đăng nhập thành công !'
                ]);
            } else {
                return \response()->json([
                    'status' => 'danger',
                    'mess' => 'Sai email hoặc mật khẩu !'
                ]);
            }
        } catch (Exception $e) {
            return \response()->json([
                'status' => 'danger',
                'mess' => 'Đăng nhập thất bại, liên hệ bộ phận CSKH để được hỗ trợ!'
            ]);
        }
    }
    public function log_out(Request $request)
    {
        Auth::user()->status = 0;
        Auth::user()->save();
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    public function register(Request $request)
    {
        $data_request = $request->only('username', 'password', 'email');
        try {
            DB::beginTransaction();
            $check = UserModel::where('email', $request->email)->first();
            if ($check != null) {
                return \response()->json([
                    'status' => 'danger',
                    'mess' => 'Email này đã được đăng ký trước đó !'
                ]);
            }
            UserModel::create([
                'user_name' => $data_request['username'],
                'password' => $data_request['password'],
                'email' => $data_request['email'],
                'level' => 'user',
                'membership_id' => 1,
                'refresh_token' => Str::random(60),
                'status' => 1,
                'created_by' => $data_request['username']
            ]);
            DB::commit();
            return \response()->json([
                'status' => 'success',
                'mess' => 'Đăng kí thành công !'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return \response()->json([
                'status' => 'danger',
                'mess' => 'Đăng kí thất bại !' . $e->getMessage()
            ]);
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
            $user->status = 0;
            $user->refresh_token = Str::random(60);
            $user->save();
            $user->createToken('Laravel Personal Access Client')->accessToken;
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Create account ' . $request->username . ' Successfully !! </div>');
            return \redirect()->route("admin.login.view");
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;">  Create account ' . $request->username . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function admin_login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->only('email', 'password', 'admin');
        $option = $loginRequest->remember == "on" ? true : false;
        if (Auth::attempt($credentials)) {
            $user = $loginRequest->user();
            $user->createToken('Laravel Personal Access Client')->accessToken;
            $user->status = 1;
            $user->save();
            //$token = $tokenResult->token;
            //Option remember
            // if ($loginRequest->remember_me) {
            //     $token->expires_at = Carbon::now()->addWeeks(1);
            // }
            // $token->save();
            //$loginRequest->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } else
            $loginRequest->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;">  Login Fail,Try Again !! </div>');
        return \redirect()->back();
    }
    public function admin_logout(Request $request)
    {
        // dd($request->user()->token());
        // $request->user()->token()->revoke();
        //    $token = $request->user()->token();
        //    $token->revoke();

        // $token = $request->user()->token();
        // $token->revoke();
        Auth::user()->status = 0;
        Auth::user()->save();
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
