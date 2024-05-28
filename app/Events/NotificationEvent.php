<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $message;
    public $user;

    public function __construct($title, $message, $user) {
        $this->title = $title;
        $this->message  = $message;
        $this->user  = $user;
    }

    public function broadcastOn() {
        return [
            'channel-user-' . $this->user->id
        ];
    }

    public function broadcastAs() {
        return 'notification-user';
    }
}
