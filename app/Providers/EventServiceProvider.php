<?php

namespace App\Providers;

use App\Listeners\UserRegisted_SendNotificationToAdmin;
use App\Events\UserRegisted as Event_UserRegisted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
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
