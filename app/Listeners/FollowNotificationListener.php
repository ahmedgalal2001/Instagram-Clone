<?php

namespace App\Listeners;

use App\Events\FollowNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class FollowNotificationListener implements ShouldQueue
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
    public function handle(FollowNotification $event): void
    {
        info($event->follower->name);
        Session::push('notifications', [
            'message' => 'You have a new follower: ' . $event->follower->name,
            'type' => 'follow',
        ]);
    }
}
