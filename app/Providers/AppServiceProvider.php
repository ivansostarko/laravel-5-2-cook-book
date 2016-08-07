<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use View;
use Settings;
use Schema;

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

        if(Schema::hasTable('categories')) {
            $categories = Category::all();
            View::share('categories', $categories);
        }

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
