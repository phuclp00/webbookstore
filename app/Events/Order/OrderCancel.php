<?php

namespace App\Events\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCancel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-cancel');
    }
    public function broadcastAs()
    {
        return 'order-cancel';
    }
}
