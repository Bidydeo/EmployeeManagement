<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
       // Obținem utilizatorul autentificat
    $user = Auth::user();
    $employees = Employee::all();
    $attendances = Attendance::all();
    // Verificăm dacă utilizatorul are rolul de superadmin
    if ($user->hasRole('Super Admin')) {
        // Superadmin vede toate cererile de concediu
        $leaves = Leave::all();
    } else {
        abort('403');
    }
    return view('admin.dashboard', compact('leaves','employees','leaves','attendances','user'));
    }
}
