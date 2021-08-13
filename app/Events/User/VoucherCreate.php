<?php

namespace App\Events\User;

use App\Models\UserModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoucherCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $voucher;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserModel $user, $voucher)
    {
        $this->user = $user;
        $this->voucher = $voucher;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('voucher-create');
    }
    public function broadcastWith()
    {
        $extra = [
            'name' => $this->user->user_name,
            'email' => $this->user->email
        ];
        return \array_merge($this->user->toArray(), $extra);
    }
    public function broadcastAs()
    {
        return 'user-registed';
    }
}
