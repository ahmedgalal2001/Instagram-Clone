<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $following;
    public $follower;

    /**
     * Create a new event instance.
     */
    public function __construct($follower, $following)
    {
        $this->follower = $follower;
        $this->following = $following;
    }

    public function broadcastOn()
    {
        return new Channel('like');
    }
    public function broadcastAs()
    {
        return "like";
    }
}
