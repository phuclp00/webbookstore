<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRestore extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $guest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $guest)
    {
        $this->order = $order;
        $this->guest = $guest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.sections.static.email-order-restore');
    }
}
