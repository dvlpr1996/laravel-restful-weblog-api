<?php

namespace App\Listeners;

use App\Events\Like;
use App\Notifications\LikeMailNotification;

class SendLikeMailNotification
{
    public function handle(Like $event)
    {
        $event->ownerType->notify(new LikeMailNotification($event->likedBy, $event->liked));
    }
}
