<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
        if($this->app->environment('production') || $this->app->environment('staging')) {
            URL::forceScheme('https');
        }
        
        Blade::if('role', function($role) {
            return Auth::check() && Auth::user()->hasRole($role);
        });
    }
}
