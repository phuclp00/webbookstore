<?php

namespace App\Listeners\User;

use App\Events\User\UserRegisted;
use App\Models\UserModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserRegistedNotification;

class UserRegisted_SendNotificationToAdmin
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

        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $this->user = $event;
                $user->notify(new UserRegistedNotification($event->user));
            }
        }
    }
    public function failed(UserRegisted $event, $exception)
    {
        //
    }
}
