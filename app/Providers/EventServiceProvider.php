<?php

namespace App\Providers;

use App\Events\AddressListed;
use App\Events\CommentMade;
use App\Events\CommentReplied;
use App\Listeners\SendAddressListedNotification;
use App\Listeners\SendCommentMadeNotification;
use App\Listeners\SendCommentRepliedNotification;
use App\Listeners\SendCounterExpiredNotification;
use App\Notifications\CounterExpired;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentReplied::class => [
            SendCommentRepliedNotification::class,
        ],
        CommentMade::class => [
            SendCommentMadeNotification::class,
        ],
        AddressListed::class => [
            SendAddressListedNotification::class,
        ],
        CounterExpired::class => [
            SendCounterExpiredNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
