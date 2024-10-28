<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdateLastActive
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
public function handle($event)
{
    if ($event instanceof Login) {
        $user = Auth::user();
        $user->last_active = now();
        $user->save();
    } elseif ($event instanceof Logout) {
        $user = Auth::user();
        $user->last_active = now();
        $user->save();
    }
}

}