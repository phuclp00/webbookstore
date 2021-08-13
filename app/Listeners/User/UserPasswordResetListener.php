<?php

namespace App\Listeners\User;

use App\Events\User\UserPasswrodReset;
use App\Mail\ResetPassword;
use App\Mail\UserRegisterMail;
use App\Models\UserModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserRegistedNotification;
use App\Notifications\User\UserResetPasswordNotification;
use App\Notifications\User\UserResetPasswordNotificationToAdmin;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Support\Facades\Mail;

class UserPasswordResetListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function handle(UserPasswrodReset $event)
    {
        $user = $event->user;
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $admin) {
                $admin->notify(new UserResetPasswordNotificationToAdmin($user));
            }
        }
       // Mail::to($user)->send(new ResetPassword($user));
        $user->notify(new UserResetPasswordNotification($user));
    }
    public function failed(UserPasswrodReset $event, $exception)
    {
        //
    }
}
