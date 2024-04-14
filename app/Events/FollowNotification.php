<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;


class FollowNotification implements ShouldBroadcast
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
        return new Channel('follow');
    }
    public function broadcastAs()
    {
        return "follow";
    }
}
