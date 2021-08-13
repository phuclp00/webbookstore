<?php

namespace App\Notifications\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestCancelOrderListener extends Notification
{
    use Queueable;
    public $order;
    public $mess;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $mess)
    {
        $this->order = $order;
        $this->mess = $mess;
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
            ->subject('Request Cancel Order')
            ->greeting('Deer Admin !')
            ->line('You currently have an order cancellation request from user')
            ->line('Order ID: ' . $this->order->id)
            ->line('Reason for order cancellation: ' . $this->mess)
            ->action('Check in dashboard', url('/admin/dashboard'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->order->id,
            'data' => 'The order ' . $this->order->id . ' has just received a cancellation with the reason:' . $this->mess
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
