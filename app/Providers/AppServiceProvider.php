<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Only force HTTPS in production when explicitly set
        if (app()->environment('production') && config('app.url') && str_starts_with(config('app.url'), 'https')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        // Share categories with ALL views (used by navbar, logo-bar, footer)
        View::composer('*', function ($view) {
            $categories = Category::orderBy('category_name')->get();

            $view->with([
                'navCategories'    => $categories->take(5),
                'otherCategories'  => $categories->skip(5),
                'circleCategories' => $categories,
            ]);
        });
    }
}
