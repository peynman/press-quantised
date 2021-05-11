<?php

namespace Larapress\Quantied\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // sync quantied in_stock on product
        'Larapress\ECommerce\Services\Cart\CartPurchasedEvent' => [
            'Larapress\Quantied\Services\QuantiedProduct\SyncInStockOnCartPurchase'
        ],
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
