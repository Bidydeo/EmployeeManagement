<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Location;
use App\Policies\CompanyPolicy;
use App\Policies\LocationPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    Company::class => CompanyPolicy::class,
    Location::class => LocationPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
