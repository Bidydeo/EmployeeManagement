<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class UserLayoutComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();

        $layout = match (true) {
            $user?->hasRole('Super Admin') => 'layouts.master',
            $user?->hasRole('Employee||Manager') => 'layouts.users.master',
            default                        => 'layouts.guest', // fallback
        };
        $view->with('userLayout', $layout);
    }
}