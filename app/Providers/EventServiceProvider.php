<?php

namespace App\Providers;

use App\Events\OfferUpdated;
use App\Events\ProductUpdated;
use App\Events\ProductUpdateReceived;
use App\Listeners\OfferUpdatedListener;
use App\Listeners\ProductUpdatedListener;
use App\Listeners\ProductUpdateReceivedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ProductUpdateReceived::class => [
            ProductUpdateReceivedListener::class,
        ],
        ProductUpdated::class => [
            ProductUpdatedListener::class,
        ],
        OfferUpdated::class => [
            OfferUpdatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
