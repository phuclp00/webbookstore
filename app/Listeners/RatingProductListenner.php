<?php

namespace App\Listeners;

use App\Http\Resources\User;
use App\Models\UserModel;
use App\Notifications\RatingSuccess;
use App\Notifications\RatingSuccessToAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RatingProductListenner
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
        $user = $event->user;
        $product = $event->product;
        $admin = UserModel::where('level', 'admin')->get();
        $user->notify(new RatingSuccess($user, $product));
        if ($admin != null) {
            foreach ($admin as $user) {
                $user->notify(new RatingSuccessToAdmin($user, $product));
            }
        }
    }
}
