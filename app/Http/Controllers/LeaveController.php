<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Notifications\LeaveCreated;
use App\Notifications\LeaveManagerApproved;
use App\Notifications\LeaveSubstituteApproved;
use App\Notifications\LeaveUpdated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;



class LeaveController extends Controller
{
    public function index()
    {
       // Obținem utilizatorul autentificat
    $user = Auth::user();
    // Verificăm dacă utilizatorul are rolul de superadmin
    if ($user->hasRole('Super Admin')) {
        // Superadmin vede toate cererile de concediu
        $leaves = Leave::all();
    } else {
        // Utilizatorul obișnuit vede doar cererile proprii
        $employee = $user->employee;
        $leaves = Leave::where('employee_id', $employee->id)
            ->orWhere('substitute_employee_id', $employee->id)
            ->orWhere('manager_id', $employee->id) // Adaugă această linie
            ->get();
    }
    return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        $user = Auth::user();
        $employee = $user->employee;

        // Obținem colegii de muncă (înlocuitori) și tipurile de concediu
        $employees = Employee::where('company_id', $employee->company_id)->get();
        $leaveTypes = LeaveType::all();

        return view('leaves.create', compact('employees', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;
        $manager_id = $employee->department->manager_id;
        // Validare date
        $validated = $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'substitute_employee_id' => 'nullable|exists:employees,id',
            // 'reason' => 'string|max:255', //Daca vrem sa fie obligatoriu de completat
        ]);

        // Calculare zile de concediu pentru concediul de odihnă
        $leaveDaysAllowed = $this->calculateVacationDays($employee, $request->start_date, $request->end_date);
        if ($leaveDaysAllowed < 0) {
            return redirect()->back()->withErrors('Numărul de zile de concediu depășește limita permisă.');
        }
    $leave = new Leave();
    $leave->employee_id =  Auth::user()->employee->id;
    $leave->leave_type_id = $request->input('leave_type_id');
    $leave->start_date = $request->input('start_date');
    $leave->end_date = $request->input('end_date');
    $leave->substitute_employee_id = $request->input('substitute_employee_id');
    $leave->manager_id = $manager_id;
    $leave->reason = $request->input('reason');
    $leave->save();
    
    $recipient = $leave->substitute_employee ?? $leave->employee->department->manager;

    $recipient->notify(new LeaveCreated($leave));
// folosesc pentru test ca sa vad cum arata emailul
    Notification::route('mail', [
    'admin@dev.neotechnik.ro' => 'Razvan',
    ])->notify(new LeaveCreated($leave));


    $message = $leave->substitute_employee 
    ? 'Cererea de concediu a fost creată și notificarea a fost trimisă persoanei inlocuitoare.' 
    : 'Cererea de concediu a fost creată și notificarea a fost trimisă managerului de departament.';

    return redirect()->route('leaves.index')->with('success', $message);
    
    }
    // Metodă pentru calcularea zilelor de concediu rămase
    private function calculateVacationDays(Employee $employee, $startDate, $endDate)
    {
        $employmentDate = Carbon::parse($employee->job_start_date); // Data angajării
        $currentYear = now()->year;
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();
        // Număr de zile totale pentru concediu în acest an
        $totalVacationDays = 21; // Exemplu - setat la 21 zile, poate fi ajustat
        $workedDaysThisYear = $employmentDate->diffInDays($endOfYear);

        // Zilele de concediu acumulate până la cererea actuală
        $accumulatedDays = round(($totalVacationDays / 365) * $workedDaysThisYear);

        // Calculăm zilele cerute în cererea de concediu
        $leaveRequestedDays = (new \Carbon\Carbon($startDate))->diffInDays(new \Carbon\Carbon($endDate)) + 1;

        return $accumulatedDays - $leaveRequestedDays;
    }
    public function edit($leaveId)
        {
            $leave = Leave::findOrFail($leaveId);
            $leaves = Leave::all();
            $employees = Auth::user()->employee->company->employees;
            $leave_types = LeaveType::all();
            return view('leaves.edit', compact('leave','leaves','employees','leave_types'));
        }
    public function update(Request $request, $leaveId)
        {
            $leave = Leave::findOrFail($leaveId);

            // Validarea datelor introduse în formular
            $request->validate([
                'leave_type_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'substitute_employee_id' => 'nullable|exists:employees,id',
                // 'reason'=> 'string|max:255', //Daca vrem sa fie obligatoriu de completat
            ]);

            // Actualizarea cererii de concediu
            $leave->leave_type_id = $request->input('leave_type_id');
            $leave->start_date = $request->input('start_date');
            $leave->end_date = $request->input('end_date');
            $leave->substitute_employee_id = $request->input('substitute_employee_id');
            $leave->reason = $request->input('reason'); // Dacă ai câmp pentru motivul concediului
            $leave->save();

            $recipient = $leave->substitute_employee ?? $leave->employee->department->manager;

            $recipient->notify(new LeaveUpdated($leave));
        // folosesc pentru test ca sa vad cum arata emailul
    Notification::route('mail', [
    'admin@dev.neotechnik.ro' => 'Razvan',
    ])->notify(new LeaveCreated($leave));

        $message = $leave->substitute_employee 
        ? 'Cererea de concediu a fost actualizate și notificarea a fost trimisă persoanei inlocuitoare.' 
        : 'Cererea de concediu a fost actualizate și notificarea a fost trimisă managerului de departament.';
        

        return redirect()->route('leaves.index')->with('success', $message);
    
        }
    public function destroy($leaveId)
    {
        $leave = Leave::findOrFail($leaveId);
        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'Cererea de concediu a fost ștearsă.');
    }


    public function substituteApproved($leaveId)
    {
        $leaveApproval = Leave::findOrFail($leaveId);
        $leaveApproval->substituteApproved = true;
        $leaveApproval->status = 'approvedBySubstitute';
        $leaveApproval->substitute_action_date = now();
        $leaveApproval->save();

        // Notificăm managerul după aprobarea înlocuitorului
        //$this->notifyManager($leaveApproval);
        Notification::route('mail', [
    'admin@dev.neotechnik.ro' => 'Razvan',
    ])->notify(new LeaveSubstituteApproved($leaveApproval));
        return redirect()->back()->with('status', 'Cererea a fost aprobată de înlocuitor.');
    }
        public function substituteRejected($leaveId)
    {
        $leaveApproval = Leave::findOrFail($leaveId);
        $leaveApproval->substituteApproved = false;
        $leaveApproval->status = 'rejectedBySubstitute';
        $leaveApproval->save();

        // Notificăm managerul după aprobarea înlocuitorului
        //$this->notifyManager($leaveApproval);

        return redirect()->back()->with('status', 'Cererea a fost respinsa de înlocuitor.');
    }
    public function managerApproved(Request $request, $leaveId)
    {
        $leaveApproval = Leave::findOrFail($leaveId);
        $leaveApproval->managerApproved = true;
        $leaveApproval->status = 'approved';
        $leaveApproval->manager_action_date = now();
        $leaveApproval->save();

           Notification::route('mail', [
    'admin@dev.neotechnik.ro' => 'Razvan',
    ])->notify(new LeaveManagerApproved($leaveApproval));
        return redirect()->route('leaves.index')->with('success', 'Cererea de concediu a fost aprobată de manager');
    }

    public function managerRejected(Request $request, $leaveId)
    {
        $leaveApproval = Leave::findOrFail($leaveId);
        $leaveApproval->managerApproved = false;
        $leaveApproval->status = 'rejected';
        $leaveApproval->save();

        return redirect()->route('leaves.index')->with('error', 'Cererea de concediu a fost respinsă de manager.');
    }

}
