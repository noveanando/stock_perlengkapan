<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        if (env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }

        // if (env("SQL_DEBUG_LOG"))
        // {
        //     \DB::listen(function ($query) {
        //         \Log::debug("DB: " . $query->sql . "[".  implode(",",$query->bindings). "] time : ".$query->time);
        //     });
        // }
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
