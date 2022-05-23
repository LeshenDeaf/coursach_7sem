<?php

namespace App\Listeners;

use App\Notifications\CounterExpired;
use Illuminate\Support\Facades\Notification;

class SendCounterExpiredNotification
{
    public function handle($event)
    {
        Notification::send(
            $event->users,
            new CounterExpired($event->counter)
        );
    }
}
