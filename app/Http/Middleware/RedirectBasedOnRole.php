<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

    class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        // if ($request->user()) {
        //     // Direcționează utilizatorii în funcție de rol
        //     if ($request->user()->hasRole('Super Admin')) {
        //         return redirect()->route('admin.dashboard');
        //     } else {
        //         return redirect()->route('dashboard');
        //     } 
        // }

        // return $next($request);
    }
    
}
