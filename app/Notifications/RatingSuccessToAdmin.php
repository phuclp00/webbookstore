<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RatingSuccessToAdmin extends Notification
{
    use Queueable;
    public $user;
    public $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $product)
    {
        $this->user = $user;
        $this->product = $product;
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
            ->subject('Product Rating Succes')
            ->greeting('You already have a notifications from system !')
            ->line('Product' . $this->product->book_name . 'has been rated by user' . $this->user->user_name)
            ->action('Check In Sysytem', '/admin/dashboard');
    }
    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->user->id,
            'data' => 'Product ' . $this->product->book_name . 'has been rated by user' . $this->user->user_name
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
