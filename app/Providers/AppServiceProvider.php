<?php

namespace App\Providers;

use App\Services\DefaultCryptoService;
use App\Storage\InMemoryStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the UrlStorage implementation
        $this->app->singleton('App\Contracts\UrlStorage', function ($app) {
            return new InMemoryStorage();
        });

        // Register the CryptoService implementation
        $this->app->singleton('App\Contracts\CryptoService', function ($app) {
            return new DefaultCryptoService($app->make('App\Contracts\UrlStorage'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
