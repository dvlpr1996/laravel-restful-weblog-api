<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Like
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $likedBy;
    public $ownerType;
    public $liked;

    public function __construct($likedBy, $ownerType, $liked)
    {
        $this->likedBy = $likedBy;
        $this->ownerType = $ownerType;
        $this->liked = $liked;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
