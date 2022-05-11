<?php

namespace App\Listeners;

use App\Notifications\CommentMade;
use Illuminate\Support\Facades\Notification;

class SendCommentMadeNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->comment->thread->user, new CommentMade($event->comment));
    }
}
