<?php

namespace App\Providers;

use App\Events\Like;
use App\Events\Login;
use App\Models\Image;
use App\Models\Comment;
use App\Events\DeleteAccount;
use App\Observers\ImageObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendLoginNotification;
use App\Listeners\SendLikeMailNotification;
use App\Notifications\DeleteAccountNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            SendLoginNotification::class,
        ],
        DeleteAccount::class => [
            DeleteAccountNotification::class,
        ],
        Like::class => [
            SendLikeMailNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Image::observe(ImageObserver::class);
        Comment::observe(CommentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
