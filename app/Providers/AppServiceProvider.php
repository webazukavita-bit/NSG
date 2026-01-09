<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        $Configuration = new Controller();
        $Configuration->GenerateConfig();
        view()->composer('front.layouts.footer', function ($view) {
            $categories = ProductCategory::limit(5)->get();
            $view->with('categories', $categories);
        });
    }
}
