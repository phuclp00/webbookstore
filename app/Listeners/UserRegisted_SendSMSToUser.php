<?php

namespace App\Listeners;

use App\Events\UserRegisted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisted_SendSMSToUser
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
     * @param  UserRegisted  $event
     * @return void
     */
    public function handle(UserRegisted $event)
    {
        //
    }
}
