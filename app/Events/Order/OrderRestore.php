<?php

namespace App\Events\Order;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderRestore
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    public $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $email)
    {
        $this->order = $order;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-restore');
    }
    public function broadcastAs()
    {
        return 'order-restore';
    }
}
