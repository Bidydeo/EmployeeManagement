<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

// Obține angajatul curent
$currentEmployee = Auth::user()->employee;

// Verifică dacă angajatul este găsit și are companie
$substituteEmployees = [];
if ($currentEmployee && $currentEmployee->company_id) {
    $substituteEmployees = Employee::where('company_id', $currentEmployee->company_id)
        ->where('id', '!=', $currentEmployee->id) // Exclude pe sine
        ->pluck('employee_name', 'id')
        ->toArray();
}

$leaveTypes = \App\Models\LeaveType::pluck('name', 'id')->toArray();

return [
    [
        'name' => 'leave_type_id',
        'type' => 'select',
        'label' => 'Tip concediu',
        'options' => $leaveTypes,
    ],
    [
        'name' => 'start_date',
        'type' => 'date',
        'label' => 'Data început',
    ],
    [
        'name' => 'end_date',
        'type' => 'date',
        'label' => 'Data sfârșit',
    ],
    [
        'name' => 'substitute_employee_id',
        'type' => 'select',
        'label' => 'Înlocuitor',
        'options' => $substituteEmployees,
    ],
    [
        'name' => 'reason',
        'type' => 'textarea',
        'label' => 'Motiv',
    ],
];
