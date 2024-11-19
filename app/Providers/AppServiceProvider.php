<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        // Add the directory for Blade components
        Blade::componentNamespace('App\\View\\Components\\Icons', 'icons');
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('WRATS_SystemAdmin_user')) {
                return true;
            }
        });
        Paginator::useBootstrapFive();
        Paginator::defaultView('vendor.pagination.bootstrap-5');

    }
}
