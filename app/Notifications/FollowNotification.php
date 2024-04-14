<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected User $follower;
    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            "follower_name" => $this->follower->name,
        ]);
    }
}
