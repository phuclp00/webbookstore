<?php

namespace App\Providers;

use App\Events\NotificationEvent;
use App\Events\UserRegistedEvent;
use App\Events\UserTracker;
use App\Listeners\SendPodcastNotification;
use App\Listeners\SendUserRegistedNotification;
use App\Listeners\UserRegisted_SendNotificationToAdmin;
use App\Models\UserDetail;
use App\Models\UserModel;
use App\Notifications\UserRegisted;
use App\Events\UserRegisted as Event_UserRegisted;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Contracts\Events\Dispatcher;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // NotificationEvent::class => [
        //     // SendEmailVerificationNotification::class,
        //     //UserModel::class,
        //     //SendPodcastNotification::class,
        //     //UserRegisted::class,
        //     SendPodcastNotification::class,
        // ],
        Event_UserRegisted::class => [
            UserRegisted_SendNotificationToAdmin::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

        Event::listen(
            Event_UserRegisted::class,
            [UserRegisted_SendNotificationToAdmin::class, 'handle']
        );

        Event::listen(function (Event_UserRegisted $event) {
            parent::boot($event);
        });
    }
}
