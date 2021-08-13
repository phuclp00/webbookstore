<?php

namespace App\Providers;

use App\Events\Order\OrderCancel;
use App\Events\Order\OrderComplete;
use App\Events\Order\OrderRestore;
use App\Events\Order\OrderSuccess;
use App\Events\Order\StatusUpdate;
use App\Events\Promotion\PromotionStart;
use App\Events\RatingProduct;
use App\Events\Request\RequestCancelOrder;
use App\Events\SendEmailContact;
use App\Events\User\UserPasswrodReset;
use App\Events\User\UserRegisted;
use App\Events\User\VoucherCreate;
use App\Listeners\Order\OrderCancelListenner;
use App\Listeners\Order\OrderCompleteNotification;
use App\Listeners\Order\OrderRestoreListener;
use App\Listeners\Order\OrderSuccessListener;
use App\Listeners\Order\OrderUpdateStatusListener;
use App\Listeners\Promotion\PromotionStartListener;
use App\Listeners\RatingProductListenner;
use App\Listeners\Request\RequestCancelOrderListener;
use App\Listeners\SendEmailContactListener;
use App\Listeners\User\UserPasswordResetListener;
use App\Listeners\User\UserRegisted_SendNotificationToAdmin;
use App\Listeners\User\VoucherCreateListener;
use App\Models\Author;
use App\Models\BookPromotions;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\TagsModel;
use App\Models\UserModel;
use App\Notifications\SendEmailContactNotification;
use App\Notifications\User\UserResetPasswordNotification;
use App\Observers\AuthorObserver;
use App\Observers\OrderObserver;
use App\Observers\Product;
use App\Observers\Promotion;
use App\Observers\Tags;
use App\Observers\UserObserver;
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

        //     //User Listen
        // Event_UserRegisted::class => [
        //     UserRegisted_SendNotificationToAdmin::class,
        // ],
        //     //Order Event
        //     OrderComplete::class => [
        //         OrderCompleteNotification::class
        //     ]

    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //Obseve class fire 

        UserModel::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        ProductModel::observe(Product::class);
        BookPromotions::observe(Promotion::class);
        TagsModel::observe(Tags::class);
        Author::observe(AuthorObserver::class);
        //Event listener register
        Event::listen(UserRegisted::class, [UserRegisted_SendNotificationToAdmin::class, 'handle']);
        Event::listen(UserPasswrodReset::class, [UserPasswordResetListener::class, 'handle']);
        Event::listen(OrderComplete::class, [OrderCompleteNotification::class, 'handle']);
        Event::listen(VoucherCreate::class, [VoucherCreateListener::class, 'handle']);
        Event::listen(StatusUpdate::class, [OrderUpdateStatusListener::class, 'handle']);
        Event::listen(OrderSuccess::class, [OrderSuccessListener::class, 'handle']);
        Event::listen(OrderCancel::class, [OrderCancelListenner::class, 'handle']);
        Event::listen(OrderRestore::class, [OrderRestoreListener::class, 'handle']);
        Event::listen(RatingProduct::class, [RatingProductListenner::class, 'handle']);
        Event::listen(RequestCancelOrder::class, [RequestCancelOrderListener::class, 'handle']);
        Event::listen(SendEmailContact::class, [SendEmailContactListener::class, 'handle']);
        Event::listen(PromotionStart::class, [PromotionStartListener::class, 'handle']);
        // Event::listen(function (UserRegisted $event) {
        //     parent::boot($event);
        // });
    }
}
