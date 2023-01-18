<?php

namespace App\Listeners;

use App\Events\DeleteAccount;
use App\Notifications\DeleteAccountNotification;

class SendDeleteAccountMailNotification
{
    public function handle(DeleteAccount $event)
    {
        $event->user->notify(new DeleteAccountNotification());
    }
}
