<?php

namespace App\Notifications;

use App\Models\Forum\ThreadComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentMade extends Notification
{
    use Queueable;

    public ThreadComment $comment;

    public function __construct(ThreadComment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $user = $this->comment->user;
        $arr = $this->comment->toArray();
        $arr["_message"] = "{$user->name} posted a comment under your thread";

        return $arr;
    }

    public function toArray($notifiable): array
    {
        $user = $this->comment->user;
        $arr = $this->comment->toArray();
        $arr["_message"] = "{$user->name} posted a comment under your thread";

        return $arr;
    }
}
