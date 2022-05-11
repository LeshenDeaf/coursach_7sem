<?php

namespace App\Listeners;

use App\Notifications\AddressListed;
use Illuminate\Support\Facades\Notification;

class SendAddressListedNotification
{
    public function handle($event)
    {
        Notification::send(
            $event->thread->address->users,
            new AddressListed($event->thread)
        );
    }
}
