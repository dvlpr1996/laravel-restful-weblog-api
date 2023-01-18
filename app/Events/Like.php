<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
