<?php

namespace App\Observers;

use App\Events\User\UserRegisted;
use App\Http\Resources\User;
use App\Mail\UserRegisterMail;
use App\Models\UserModel;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class UserObserver
{
    /**
     * Handle the UserModel "created" event.
     *
     * @param  \App\Models\UserModel  $userModel
     * @return void
     */
    private function update_users_total()
    {
        $data = UserModel::all()->count();
        return  Redis::set('users:total', $data);
    }

    public function created(UserModel $userModel)
    {
        $voucher = Vouchers::create(
            $userModel,
            1,
            [
                'from' => 'Booksto',
                'to' => 'Customer registed account at booksto.tk ',
                'percent' => '5',
                'type' => 'user'
            ],
            today()->addHours(24),
            1
        );
        Mail::to($userModel)->send(new UserRegisterMail($userModel, $voucher));
        event(new UserRegisted($userModel));
        $this->update_users_total();
    }

    /**
     * Handle the UserModel "updated" event.
     *
     * @param  \App\Models\UserModel  $userModel
     * @return void
     */
    public function updated(UserModel $userModel)
    {
        $this->update_users_total();
    }

    /**
     * Handle the UserModel "deleted" event.
     *
     * @param  \App\Models\UserModel  $userModel
     * @return void
     */
    public function deleted(UserModel $userModel)
    {
        $this->update_users_total();
    }

    /**
     * Handle the UserModel "restored" event.
     *
     * @param  \App\Models\UserModel  $userModel
     * @return void
     */
    public function restored(UserModel $userModel)
    {
        $this->update_users_total();
    }

    /**
     * Handle the UserModel "force deleted" event.
     *
     * @param  \App\Models\UserModel  $userModel
     * @return void
     */
    public function forceDeleted(UserModel $userModel)
    {
        $this->update_users_total();
    }
}
