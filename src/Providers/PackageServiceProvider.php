<?php

namespace Larapress\Quantied\Providers;

use Illuminate\Support\ServiceProvider;
use Larapress\Quantied\Commands\QuantiedCreateProductType;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'larapress');

        $this->publishes([
            __DIR__.'/../../config/quantied.php' => config_path('larapress/quantied.php'),
        ], ['config', 'larapress', 'larapress-quantied']);

        if ($this->app->runningInConsole()) {
            $this->commands([
                QuantiedCreateProductType::class,
            ]);
        }
    }
}
