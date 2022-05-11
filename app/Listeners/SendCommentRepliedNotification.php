<?php

namespace App\Listeners;

use App\Notifications\CommentReplied;
use Illuminate\Support\Facades\Notification;

class SendCommentRepliedNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->comment->parent->user, new CommentReplied($event->comment));
    }
}
