<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TeamController extends Controller
{
    use AuthorizesRequests;
    public function index()
{
    $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            $teams = Team::all();
        } else {
            $teams = $user->employee?->teams ?? collect();
        }

    
    return view('teams.index', compact('teams'));
}
}
