<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailContactNotification extends Notification
{
    use Queueable;
    public $name, $email, $phone, $mess;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $mess)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mess = $mess;
        $this->phone = $phone;
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
            ->subject('Email Contact From Customer')
            ->greeting('Dear Admin !')
            ->line('Name: ' . $this->name)
            ->line('Email: ' . $this->email)
            ->line('Phone: ' . $this->phone)
            ->line('Messenge : ' . $this->mess);
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->name,
            'data' => 'You just received an email from user' . $this->name
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
