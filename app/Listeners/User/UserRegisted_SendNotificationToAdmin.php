<?php

namespace App\Listeners\User;

use App\Events\User\UserRegisted;
use App\Mail\UserRegisterMail;
use App\Models\UserModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserRegistedNotification;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Support\Facades\Mail;

class UserRegisted_SendNotificationToAdmin implements ShouldQueue
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

    /**
     * Handle the event.
     *
     * @param  UserRegisted  $event
     * @return void
     */

    public function handle(UserRegisted $event)
    {
        $user = $event->user;
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $admin) {
                $admin->notify(new UserRegistedNotification($user));
            }
        }
    }
    public function failed(UserRegisted $event, $exception)
    {
        //
    }
}
