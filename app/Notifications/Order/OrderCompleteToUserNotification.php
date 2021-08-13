<?php

namespace App\Notifications\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCompleteToUserNotification extends Notification
{
    use Queueable;
    public $order;
    public $voucher;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $voucher)
    {
        $this->order = $order;
        $this->voucher = $voucher;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Complete Booksto')
            ->view('client.sections.static.email-order-complete', ["order" => $this->order, 'voucher' => $this->voucher]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->order->id,
            'data' => 'Đơn hàng ' . $this->order->id . 'của bạn đã được hoàn thành '
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
