<?php

namespace App\Listeners\User;

use App\Events\User\VoucherCreate;
use App\Http\Resources\User;
use App\Mail\VoucherCreate as MailVoucherCreate;
use App\Models\UserModel;
use App\Notifications\User\VoucherCreateNotification;
use App\Notifications\User\VoucherCreateNotification_toAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class VoucherCreateListener implements ShouldQueue
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VoucherCreate $event)
    {
        $user = $event->user;
        $voucher = $event->voucher;
        $user->notify(new VoucherCreateNotification($user, $voucher));
        $result = UserModel::where('level', '=', 'admin')->get();
        if ($result != null) {
            foreach ($result as $user) {
                $user->notify(new VoucherCreateNotification_toAdmin($user,$voucher));
            }
        }
    }
}
