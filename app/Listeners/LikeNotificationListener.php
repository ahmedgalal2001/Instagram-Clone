<?php

namespace App\Listeners;

use App\Events\LikeNotification;
use App\Models\Notification;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LikeNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LikeNotification $event): void
    {
        info($event->follower);
        info($event->following);
        try {
            $notification = new Notification();
            $notification->senderId = $event->follower;
            $notification->reciverId = $event->following;
            $notification->seen = false;
            $notification->message = 'Like';
            $notification->save();
        } catch (Exception $e) {
            info($e->getMessage());
        }
    }
}
