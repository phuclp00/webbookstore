<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderComplete;
use App\Http\Resources\User;
use App\Mail\OrderComplete as MailOrderComplete;
use App\Models\Guest;
use App\Models\Membership;
use App\Models\Order;
use App\Models\UserModel;
use App\Notifications\Order\OrderCompleteNotification as OrderOrderCompleteNotification;
use App\Notifications\Order\OrderCompleteToUserNotification;
use BeyondCode\Vouchers\Facades\Vouchers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrderCompleteNotification implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function handle($event)
    {
        $customer = $event->user;
        $voucher = null;
        $order = $event->order;
        $user_account = UserModel::where('email', $customer->email)->first();
        //Create voucher if customer spend over 50k 
        if ($order->final_price > 50000) {
            $voucher = Vouchers::create(
                $customer,
                1,
                [
                    'from' => 'Booksto',
                    'to' => 'Customer buy product at website ',
                    'percent' => '5',
                    'minium_total' => '50000',
                    'type' => 'order'
                ],
                today()->addHours(24),
                1
            );
        }
        if ($user_account) {
            $point = $user_account->points()->updateorCreate(
                ['user_id' => $user_account->user_id, 'reward_type' => 'order'],
                [
                    'reward_type' => 'order',
                    'operation_type' => 'order',
                ]
            );
            $point->reward_points += $order->final_price / 100000;
            $point->save();
            $total = $user_account->points()->sum('reward_points');
            $membership = Membership::where('valid_unit', '<=', $total)->latest()->first();
            $user_account->membership_id = $membership->id;
            $user_account->save();
            //Notify
            $user_account->notify(new OrderCompleteToUserNotification($order, $voucher));
        } else {
            $guest = Guest::where('email', $customer->email)->first();
            Mail::to($guest)->send(new MailOrderComplete($order, $voucher));
        }
        // Email to customer 
        // Mail::to($customer)->send(new MailOrder($order, $voucher));
        //Notify to admin 
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new OrderOrderCompleteNotification($order));
            }
        }
    }
    public function failed(OrderComplete $event, $exception)
    {
        //
    }
}
