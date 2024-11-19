<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuditingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        OwenIt\Auditing\AuditingServiceProvider::class;
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
