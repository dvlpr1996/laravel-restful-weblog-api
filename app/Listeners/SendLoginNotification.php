<?php

namespace App\Listeners;

use App\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\LogInEmailNotification;

class SendLoginNotification
{
    public function handle(Login $event)
    {
        $event->user->notify(new LogInEmailNotification());
    }
}
