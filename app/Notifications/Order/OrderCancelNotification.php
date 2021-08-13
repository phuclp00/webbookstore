<?php

namespace App\Notifications\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelNotification extends Notification
{
    use Queueable;
    public $order;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user = $user;
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
            ->subject('Order ' . $this->order->id . ' Has Been Canceled')
            ->view('client.sections.static.email-order-cancel', ['order' => $this->order, 'user' => $this->user]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->order->id,
            'data' => 'Order ' . $this->order->id . ' has been cancelled by' . $this->order->modified_by . '!'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
