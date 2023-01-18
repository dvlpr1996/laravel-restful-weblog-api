<?php

namespace App\Listeners;

use App\Events\Login;
use App\Notifications\LogInEmailNotification;

class SendLoginNotification
{
    public function handle(Login $event)
    {
        $event->user->notify(new LogInEmailNotification());
    }
}
