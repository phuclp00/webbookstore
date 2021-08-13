<?php

namespace App\Notifications\Promotion;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromotionStartNotification extends Notification
{
    use Queueable;
    public $promotion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($promotion)
    {
        $this->promotion = $promotion;
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
            ->subject('Promotion' . $this->promotion->name . 'has been updated !')
            ->line('The promotion has been released at' . $this->promotion->date_started)
            ->line('Last Modified At: ' . $this->promotion->modified_at)
            ->action('Check in admin dashboard', url('/admin/promotions'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->promotion->id,
            'data' => 'The promotion ' . $this->promotion->name . ' had been update at ' . $this->promotion->modified_at . '!'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
