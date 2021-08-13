<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order as OrderModel;
use BeyondCode\Vouchers\Models\Voucher;

class Order extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $voucher;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderModel $order, $voucher = null)
    {
        $this->order = $order;
        $this->voucher = $voucher;
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
