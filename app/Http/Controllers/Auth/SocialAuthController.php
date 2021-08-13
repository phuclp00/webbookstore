<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\UserModel;
use App\Services\SocialAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Socialite, Auth, Redirect, Session, URL;
use Illuminate\Support\Str;


class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->stateless()->redirect()->getTargetUrl();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->stateless()->user(), $social);
        auth()->login($user);
        return redirect()->to('/home');
    }

    public function redirectToProvider($provider)
    {
        if (!Session::has('pre_url')) {
            Session::put('pre_url', URL::previous());
        } else {
            if (URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        if ($authUser) {
            Auth::login($authUser, true);
            return redirect()->route('index');
        } else {
            return \view('errors.account-ban');
        }
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        try {
            DB::beginTransaction();
            $authUser = SocialAccount::where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser->user;
            }
            $account = UserModel::firstOrCreate([
                'email'    => $user->email,
            ], [
                'user_name' => $user->name,
                'image' => $user->avatar,
                'created_by' => 'Google Account Platform',
                'refresh_token' => Str::random(60),
                'status' => 1,
                'level' => 'user',
                'membership_id' => 1,
                'passowrd' => 'booksto1234'
            ]);
            $account->user_name = $user->name;
            $account->modified_by = "Google Account Platform";
            $account->save();
            $account->social_account()->create([
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            DB::commit();
            return $account;
        } catch (\Throwable $th) {
            DB::rollBack();
            return \response('Login with google platform was failed', 404);
        }
    }
}
