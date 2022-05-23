<?php

namespace App\Notifications;

use App\Models\Counter;
use Illuminate\Notifications\Notification;

class CounterExpired extends Notification
{
    public Counter $counter;
    public $users;

    public function __construct(Counter $counter)
    {
        $this->counter = $counter;
        $this->users = $this->counter->address->users;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $address = $this->counter->address;

        $arr = $this->counter->toArray();
        $arr['address'] = $address->address;
        $arr['users'] = $this->users;
        $arr['_message'] = "Counter №{$this->counter->factory_number} in {$address->address} must be verificated at {$this->counter->valid_until}";

        return $arr;
    }

    public function toArray($notifiable): array
    {
        $address = $this->counter->address;

        $arr = $this->counter->toArray();
        $arr['address'] = $address->address;
        $arr['users'] = $this->users ;
        $arr['_message'] = "Counter №{$this->counter->factory_number} in {$address->address} must be verificated at {$this->counter->verification_date}";

        return $arr;
    }
}
