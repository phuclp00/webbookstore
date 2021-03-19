<?php

namespace App\Events;

use App\Models\UserModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisted  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('user-registed');
        return new PrivateChannel('user-registed');
    }
    // public function broadcastWith()
    // {
    //     $extra=[
    //         'name'=>$this->user->user_name,
    //         'email'=>$this->user->email
    //     ];
    //     return \array_merge($this->user->toArray(),$extra);
    // }
    // public function broadcastAs()
    // {
    //     return 'user-registed';
    // }
}
