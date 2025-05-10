<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index()
{
    $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            $projects = Project::all();
        } 
        else {
            $projects = $user->employee?->projects() ?? collect();
        }
    return view('projects.index', compact('projects'));
}
}
