<?php

namespace App\Listeners\Request;

use App\Http\Resources\User;
use App\Models\UserModel;
use App\Notifications\Request\RequestCancelOrderListener as RequestRequestCancelOrderListener;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RequestCancelOrderListener
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
        $mess = $event->mess;
        $admin = UserModel::where('level', 'admin')->get();
        if ($admin) {
            foreach ($admin as $value) {
                $value->notify(new RequestRequestCancelOrderListener($order, $mess));
            }
        }
    }
}
