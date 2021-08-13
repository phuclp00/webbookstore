<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherCreateNotification_toAdmin extends Notification
{
    use Queueable;
    public $user;
    public $voucher;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $voucher)
    {
        $this->user = $user;
        $this->voucher = $voucher;
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
            'data' => 'User:' . $this->user->email . ' received voucher code ' . $this->voucher->code . ' successfully'
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'thread' => $this->user->user_id,
            'data' => 'User' . $this->user->user_name . ' has been created !',
            'notifiable' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
