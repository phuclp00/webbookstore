<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderComplete extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $voucher;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $voucher)
    {
        $this->voucher = $voucher;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.sections.static.email-order-complete');
    }
}
