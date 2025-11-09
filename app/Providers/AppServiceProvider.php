<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share settings with all views
        view()->composer('*', function ($view) {
            $view->with([
                'siteName' => \App\Models\Setting::get('site_name', config('app.name', 'Blog')),
                'siteDescription' => \App\Models\Setting::get('site_description', 'A clean and simple blog'),
                'homeTitle' => \App\Models\Setting::get('home_title', 'Blog Posts'),
                'homeDescription' => \App\Models\Setting::get('home_description', 'Discover our latest articles and insights'),
                'footerText' => \App\Models\Setting::get('footer_text', 'Powered by Laravel & Tailwind CSS'),
            ]);
        });
    }
}
