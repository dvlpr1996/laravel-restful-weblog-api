<?php

namespace App\Listeners;

use App\Events\Like;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\LikeMailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLikeMailNotification
{
    public function handle(Like $event)
    {
        $event->ownerType->notify(new LikeMailNotification($event->likedBy, $event->liked));
    }
}
