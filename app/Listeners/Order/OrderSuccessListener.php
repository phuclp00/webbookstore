<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderSuccess as OrderOrderSuccess;
use App\Mail\Order;
use App\Models\UserModel;
use App\Notifications\Order\OrderSuccess;
use App\Notifications\Order\OrderSuccessToAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class OrderSuccessListener implements ShouldQueue
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
    public function handle(OrderOrderSuccess $event)
    {
        $order = $event->order;
        $email = $event->email;
        $customer = UserModel::where('email', $email)->first();
        if ($customer == null) {
            Mail::to($email)->send(new Order($order));
        } else {
            $customer->notify(new OrderSuccess($customer, $order));
        }
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new OrderSuccessToAdmin($order));
            }
        }
    }
}
