<?php

namespace App\Listeners;

use App\Models\UserModel;
use App\Notifications\SendEmailContactNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailContactListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $name = $event->name;
        $email = $event->email;
        $phone = $event->phone;
        $mess = $event->mess;
        $admin = UserModel::where('level', 'admin')->get();
        if ($admin) {
            foreach ($admin as $user) {
                $user->notify(new SendEmailContactNotification($name, $email, $phone, $mess));
            }
        }
    }
}
