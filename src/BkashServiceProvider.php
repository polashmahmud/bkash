<?php

namespace Polashmahmud\Bkash;

use Illuminate\Support\ServiceProvider;

class BkashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->publishes([
            __DIR__.'/../config/bkash.php' => config_path('bkash.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../config/bkash.php', 'bkash'
        );
    }
}
