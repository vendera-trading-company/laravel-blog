<?php

namespace VenderaTradingCompany\LaravelBlog\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelBlogProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
