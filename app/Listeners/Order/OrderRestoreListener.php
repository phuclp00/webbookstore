<?php

namespace App\Listeners\Order;

use App\Mail\OrderRestore;
use App\Models\Guest;
use App\Models\UserModel;
use App\Notifications\Order\OrderRestoreNotification;
use App\Notifications\Order\OrderRestoreNotificationToAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Stripe\Order;

class OrderRestoreListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;
        $email = $event->email;
        //notify to user
        $user_account = UserModel::where('email', $email)->first();
        if ($user_account == null) {
            $guest = Guest::where('email', $email)->first();
            Mail::to($email)->send(new OrderRestore($order, $guest));
        } else {
            $user_account->notify(new OrderRestoreNotification($order, $user_account));
        }
        //Notify to admin
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new OrderRestoreNotificationToAdmin($order, $user_account));
            }
        }
    }
}
