<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeMailNotification extends Notification
{
    use Queueable;

    public $likedBy;
    public $liked;

    public function __construct($likedBy, $liked)
    {
        $this->likedBy = $likedBy;
        $this->liked = $liked;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('hi ' . $notifiable->fullName())
            ->line('your post : ' . $this->liked . ' liked by ' . $this->likedBy)
            ->line('at : ' . date('y-m-d'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
