<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RatingSuccess extends Notification
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
        return ['database', 'broadcast'];
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
            'thread' => $this->user->id,
            'data' => 'Cảm ơn bạn đã đánh giá sản phẩm' . $this->product->book_name . ' tại website của chúng tôi'
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
