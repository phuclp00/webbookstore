<?php

namespace App\Mail;

use App\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $voucher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserModel $user, $voucher)
    {
        $this->user = $user;
        $this->voucher = $voucher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.sections.static.email-user-register');
    }
}
