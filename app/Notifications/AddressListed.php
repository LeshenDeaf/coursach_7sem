<?php

namespace App\Notifications;

use App\Models\Forum\Thread;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddressListed extends Notification
{
    use Queueable;

    public Thread $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $user = $this->thread->user;
        $arr = $this->thread->toArray();
        $arr["_message"] = "{$user->name} pinned your address in thread";

        return $arr;
    }

    public function toArray($notifiable): array
    {
        $user = $this->thread->user;
        $arr = $this->thread->toArray();
        $arr["_message"] = "{$user->name} pinned your address in thread";

        return $arr;
    }
}
