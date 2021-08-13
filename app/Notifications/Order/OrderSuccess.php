<?php

namespace App\Notifications\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccess extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user;
    public $order;
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Success Booksto')
            ->view('client.sections.static.email-order-confim', ["order" => $this->order]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->order->id,
            'data' => 'Bạn vừa đặt 1 đơn hàng thành công. Mã đơn hàng là: ' . $this->order->id
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
