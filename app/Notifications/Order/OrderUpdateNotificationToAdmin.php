<?php

namespace App\Notifications\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderUpdateNotificationToAdmin extends Notification
{
    use Queueable;
    public $order;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $user)
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
            ->subject('Order Update Successfully  ')
            ->greeting('You already have a notifications from system !')
            ->line('Order ' . $this->order->id . ' Had Been Successfully Updated :')
            ->line($this->order->status->name)
            ->action('Check Now', url('/admin/orders/on-going'))
            ->line('Booksto System.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->order->id,
            'data' => 'Order ' . $this->order->id . ' has been successfully updated and emailed to users'
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
