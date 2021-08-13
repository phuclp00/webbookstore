<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCancel;
use App\Mail\Order\OrderCancel as OrderOrderCancel;
use App\Models\UserModel;
use App\Notifications\Order\OrderCancelNotification;
use App\Notifications\Order\OrderCancelNotificationToAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderCancelListenner implements ShouldQueue
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
        $user = $event->user;
        $user_account = UserModel::where('email', $user->email)->first();
        //notify to user/guest
        if ($user_account == null) {
            Mail::to($user)->send(new OrderOrderCancel($order, $user));
        } else {
            $user->notify(new OrderCancelNotification($order, $user));
        }
        //Notify to admin
        $result = UserModel::where('level', '=', 'admin')->get();

        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new OrderCancelNotificationToAdmin($order));
            }
        }
    }
}
