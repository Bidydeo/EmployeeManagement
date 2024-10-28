<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersDashboardController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
       // Obținem utilizatorul autentificat
    $user = Auth::user();
    $attendances = Attendance::where('employee_id', $user->employee->id)->get();
    // Verificăm dacă utilizatorul are rolul de user
    if ($user->hasRole('Employee||Manager')) {
        // Userul vede doar cererile de concediu pentru el
        $leaves = Leave::where('employee_id', $user->employee->id)->get();
    } else {
        abort('403');
    }
    return view('users.dashboard', compact('leaves','attendances','users'));
    }
}
