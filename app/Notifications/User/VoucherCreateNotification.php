<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherCreateNotification extends Notification
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
            ->subject('Voucher Promotion Booksto')
            ->view('client.sections.static.email-voucher-create', ["voucher" => $this->voucher, "user" => $this->user]);
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
            'data' => 'Bạn vừa nhận được 1 mã giảm giá :' . $this->voucher->code . 'từ quản trị viên !'
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
