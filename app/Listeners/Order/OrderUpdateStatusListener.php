<?php

namespace App\Listeners\Order;

use App\Events\Order\StatusUpdate;
use App\Mail\OrderStatusUpdate;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\UserModel;
use App\Notifications\Order\OrderUpdateNotification;
use App\Notifications\Order\OrderUpdateNotificationToAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderUpdateStatusListener implements ShouldQueue
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
    public function handle(StatusUpdate $event)
    {
        $order = $event->order;
        $customer = $event->user;
        $user = UserModel::where('email', $customer->email)->first();
        if ($user) {
            $user->notify(new OrderUpdateNotification($order, $customer));
        } else {
            Mail::to($customer)->send(new OrderStatusUpdate($customer, $order));
        }
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new OrderUpdateNotificationToAdmin($order, $user));
            }
        }
    }
}
