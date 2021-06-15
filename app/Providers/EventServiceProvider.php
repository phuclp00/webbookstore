<?php

namespace App\Providers;

use App\Listeners\User\UserRegisted_SendNotificationToAdmin;
use App\Events\User\UserRegisted as Event_UserRegisted;
use App\Listeners\Product\RemoveListenner as ProductRemove;
use App\Listeners\Product\StoreListenner as ProductStore;
use App\Listeners\Product\UpdateListenner as ProductUpdate;
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

        //User Listen
        Event_UserRegisted::class => [
            UserRegisted_SendNotificationToAdmin::class,
        ],

        //Product Listen
        ProductStore::class => [
            StoreListenner::class
        ],
        ProductRemove::class => [],
        ProductUpdate::class => [],


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
