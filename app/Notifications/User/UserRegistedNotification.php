<?php

namespace App\Notifications\User;

use App\Models\UserModel;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserRegistedNotification extends Notification
{
    use Queueable;

    public  $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
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
            'thread' => $this->user->user_id,
            'data' => 'User: ' . $this->user->user_name . ' has been created !'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            // 'thread' => $this->user->user_id,
            //'data' => 'User' . $this->user->user_name . ' has been created !'
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
