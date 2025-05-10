<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            // Super Admin vede toți angajații
            $employees = Employee::all();
        } else {
            // User normal – preluăm angajatul asociat utilizatorului
            $employee = $user->employee;

            // Dacă există un angajat, extragem compania lui
            $company = $employee->company;

            // Dacă există companie, preluăm toți angajații companiei respective
            $employees = $company ? $company->employees : collect(); // întotdeauna returnăm o colecție
        }

        return view('employees.index', compact('employees'));
    }
}
