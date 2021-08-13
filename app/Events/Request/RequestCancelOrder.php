<?php

namespace App\Events\Request;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestCancelOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    public $mess;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $mess)
    {
        $this->order = $order;
        $this->mess = $mess;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('request-order');
    }
}
