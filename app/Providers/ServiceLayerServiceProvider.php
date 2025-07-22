<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceLayerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\TimesheetServiceInterface', 'App\Services\TimesheetService');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
