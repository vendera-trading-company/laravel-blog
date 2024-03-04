<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;

class WorkbenchServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__ . '/../../../vendor/vendera-trading-company/laravel-assets/src/database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../../../src/database/migrations');
    }
}
