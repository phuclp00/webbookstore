<?php

namespace App\Events\Promotion;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PromotionStart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $promotion, $type, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($promotion, $type, $user)
    {
        $this->promotion = $promotion;
        $this->type = $type;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('promotion-started');
    }
}
