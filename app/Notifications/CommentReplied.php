<?php

namespace App\Notifications;

use App\Models\Forum\ThreadComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplied extends Notification
{
    use Queueable;

    public ThreadComment $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ThreadComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $user = $this->comment->user;
        $arr = $this->comment->toArray();
        $arr["_message"] = "{$user->name} replied to your comment";

        return $arr;
    }

    public function toArray($notifiable)
    {
        $user = $this->comment->user;
        $arr = $this->comment->toArray();
        $arr["_message"] = "{$user->name} replied to your comment";

        return $arr;
    }

}
