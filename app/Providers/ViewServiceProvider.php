<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\UserLayoutComposer;
use App\Http\ViewComposers\UsersWithUnreadMessages;


class ViewServiceProvider extends ServiceProvider
{
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
        // Share users with all layouts.navigation
    View::composer('layouts.navigation', function ($view) {
        $view->with('users', User::all());
    });
    View::composer('*', UserLayoutComposer::class);
    View::composer(
            'layouts.navigation', // sau 'layouts.nav' dacă vrei doar într-un view specific
            UsersWithUnreadMessages::class
        );
    }
}
