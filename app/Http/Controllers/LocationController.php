<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\EmployeeLocation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocationController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            $locations = Location::all();
        } else {
            $locations = $user->employee
                ? $user->employee->locations // relația many-to-many returnează o colecție
                : collect();
        }

        return view('locations.index', compact('locations'));
    }
    public function create()
    {
        $this->authorize('create', EmployeeLocation::class);
        $employees = Employee::all();
        $companies = Company::all();
        return view('locations.create', compact('companies', 'employees'));
    }
    public function store(Request $request)
    {
        // Validare date
        $validated = $request->validate([
            'company_id' =>'required',
            'name' =>'required',
            'latitude' =>'required',
            'longitude' =>'required', 
            'radius' =>'required',
            'project_id'=>'required',

            // 'employee_ids'=>'required',
        ]);
        // Salvare in baza de date
        $location = new Location();
        $location->company_id = $request->company_id;
        $location->project_id=$request->project_id;
        $location->name = $request->name;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->radius=$request->radius;
        $location->save();
        // Preia lista de employee_ids din cerere
        $employee_ids = $request->employees;
        // Verifică dacă există employee_ids și le asociază cu locația salvată
        if ($employee_ids) {
        // Folosește attach pentru a salva în tabela pivot
        $location->employees()->attach($employee_ids);
    }

    return redirect()->route('locations_index')->with('success', 'Location and employees assigned successfully.');
    }
    public function show($id)
    {
        //
    }
    public function edit(Location $location)
    {
        $this->authorize('edit', $location);
        $employees=Employee::all();
        $companies=Company::all();
        return view('locations.edit', compact('location','companies','employees'));
    }
    public function update(Request $request, Location $location)
    {
        $request->validate([
                        'name'=>'required',
                        'latitude'=>'required',
                        'longitude'=>'required', 
                        'radius'=>'required',
                        'company_id'=>'required',
                        'project_id'=>'required',

        ]);
        $employee_ids = $request->employees;
        // Verifică dacă există employee_ids și le asociază cu locația salvată
        if ($employee_ids) {
        // Folosește sync pentru a salva în tabela pivot
        $location->employees()->sync($employee_ids);}
        $location->update($request->all());
        return redirect()->route('locations_index')
            ->with('success', 'Locatia a fost actualizata cu succes!');
        
    }
    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);
    // Soft delete locația
    $location->delete();

    // Soft delete legăturile din employee_location
    EmployeeLocation::where('location_id', $location->id)->delete();

    // Soft delete prezențele aferente locației
    Attendance::where('location_id', $location->id)->delete();

    return redirect()->back()->with('success', 'Locația a fost ștearsă soft.');
    }
}
