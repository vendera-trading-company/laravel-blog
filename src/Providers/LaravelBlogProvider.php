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
        $this->publishes([
            __DIR__ . '/../database/migrations/2023_01_01_000000_create_blogs_table.php' => database_path('migrations/2023_01_01_000000_create_blogs_table.php'),
            __DIR__ . '/../database/migrations/2023_01_01_000001_create_blog_posts_table.php' => database_path('migrations/2023_01_01_000001_create_blog_posts_table.php')
        ], 'vendera-trading-company/laravel-blog/migrations');
    }
}
