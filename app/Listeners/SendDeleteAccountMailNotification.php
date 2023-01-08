<?php

namespace App\Listeners;

use App\Events\DeleteAccount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\DeleteAccountNotification;

class SendDeleteAccountMailNotification
{
    public function handle(DeleteAccount $event)
    {
        $event->user->notify(new DeleteAccountNotification());
    }
}
