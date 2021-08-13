<?php

namespace App\Mail;

use App\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $voucher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.sections.static.email-password-reset');
    }
}
