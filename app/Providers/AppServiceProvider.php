<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Dao Registeration
        $this->app->bind('App\Contracts\Dao\Post\PostDaoInterface', 'App\Dao\Post\PostDao');
        $this->app->bind('App\Contracts\Dao\Category\CategoryDaoInterface', 'App\Dao\Category\CategoryDao');

        // Business Logic Registeration
        $this->app->bind('App\Contracts\Services\Post\PostServiceInterface', 'App\Services\Post\PostService');
        $this->app->bind('App\Contracts\Services\Category\CategoryServiceInterface', 'App\Services\Category\CategoryService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
