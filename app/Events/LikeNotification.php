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
    public $userMakeLike;
    public $userHasLike;
    public $postImg;
    /**
     * Create a new event instance.
     */
    public function __construct($userMakeLike, $userHasLike , $postImg)
    {
        $this->userMakeLike = $userMakeLike;
        $this->userHasLike = $userHasLike;
        $this->postImg = $postImg;
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
