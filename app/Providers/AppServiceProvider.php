<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Show categories in all views
        $categories = \App\Models\Category::all();
        View::share('categories', $categories);

        //Google Analytics in all views
        $google_analytic = Settings::get('google_analytics');
        View::share('google_analytic', $google_analytic);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
