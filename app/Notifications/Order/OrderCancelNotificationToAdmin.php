<?php

namespace App\Notifications\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelNotificationToAdmin extends Notification
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
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
            ->greeting('Order ' . $this->order->id . ' has been cancelled!')
            ->line('Order :' . $this->order->id . 'had been cancelled by ' . $this->order->modified_by . ' !')
            ->line('Check order in admin system ')->replyTo('ithiensucodon@gmail.com', 'Locdo')
            ->action('Go to Dashboard ', url('/admin/dashboard'))
            ->line('Booksto System !');
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
