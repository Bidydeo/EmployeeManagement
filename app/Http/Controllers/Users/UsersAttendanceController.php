<?php

namespace App\Http\Controllers\Users;

use App\Events\AttendanceUpdated;
use App\Events\NewAttendanceAdded;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersAttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $employee = Auth::user()->employee; // Presupunând că utilizatorul este autentificat
        $today = now()->toDateString(); // Data curentă

         // Verifică dacă există deja un clock in pentru ziua respectivă
        // $existingClockIn = Attendance::where('employee_id', $employee->id)
        // ->whereDate('clock_in_time', $today)
        // ->first();

        // if ($existingClockIn) {
        // return response()->json(['status' => 'error','message' => 'Ai făcut deja clock-in azi.'], 400);
        // }

        // Verifică dacă există deja un clock-in fără clock-out
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->whereNull('clock_out_time') // Caută înregistrarea fără clock out
            ->first();

        // Dacă există o înregistrare de clock-in fără clock-out, returnează o eroare
        if ($existingAttendance) {
            return response()->json(['status' => 'error', 'message' => 'Already clocked in.'], 400);
        }

        // Verifică dacă angajatul are locații asociate
        if ($employee->locations->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No locations assigned to the employee.'], 400);
        }

        // Variabile pentru a găsi locația cea mai apropiată
        $closestLocation = null;
        $minDistance = INF; // Inițializăm cu o valoare foarte mare

        // Parcurgem locațiile și calculăm distanța
        foreach ($employee->locations as $location) {
            // Calculează distanța dintre coordonatele utilizatorului și locație
            $distance = $location->distanceTo($request->latitude, $request->longitude);

            // Verifică dacă angajatul este în raza specificată pentru această locație
            if ($distance <= $location->radius && $distance < $minDistance) {
                $minDistance = $distance;
                $closestLocation = $location;
            }
        }
        // Dacă nu a fost găsită nicio locație validă
        if (!$closestLocation) {
            return response()->json(['status' => 'error', 'message' => 'You are not at a valid location for clock-in.'], 400);
        }

        // Salvăm ora de intrare în tabelul 'attendances' și locația cea mai apropiată
        $attendance = Attendance::create([
            'employee_id' => $employee->id,  // ID-ul employee conectat
            'location_id' => $closestLocation->id,  // ID-ul locației celei mai apropiate și valide
            'date' => now()->toDateString(),  // Setează doar data fără timp
            'latitude_in' => $request->latitude,
            'longitude_in' => $request->longitude,
            'clock_in_time' => now(),  // Salvăm ora curentă ca ora de intrare
        ]);
        // event(new NewAttendanceAdded($attendance));
        // Returnează un răspuns JSON
        return response()->json([
        'status' => 'success',
        'data' => [
            'attendance_id'=>$attendance->id,
            'employee_name' => $attendance->employee->employee_name,
            'location_name' => $attendance->location->name,
            'day_of_week' => $attendance->clock_in_time->format('l'), // Ziua săptămânii
            'date' => $attendance->clock_in_time->format('d-m-Y'), // Data
            'clock_in_time' => $attendance->clock_in_time->format('H:i:s'), // Ora de clock-in
            'clock_out_time' => $attendance->clock_out_time ? $attendance->clock_out_time->format('H:i:s') : null // Ora de clock-out, dacă există
        ]
        ]);
    }
    public function clockOut(Request $request)
    {
        $employee = Auth::user()->employee; // Presupunând că utilizatorul este autentificat

        // Caută înregistrarea de clock-in fără clock-out
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->whereNull('clock_out_time') // Caută înregistrarea fără clock-out
            ->first();

        // Dacă nu există o înregistrare de clock-in activă, returnează o eroare
        if (!$existingAttendance) {
            return response()->json(['status' => 'error', 'message' => 'No active clock-in found.'], 400);
        }

        // Verifică dacă angajatul are locații asociate
        if ($employee->locations->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No locations assigned to the employee.'], 400);
        }

        // Variabile pentru a găsi locația cea mai apropiată
        $closestLocation = null;
        $minDistance = INF; // Inițializăm cu o valoare foarte mare

        // Parcurgem locațiile și calculăm distanța
        foreach ($employee->locations as $location) {
            // Calculează distanța dintre coordonatele utilizatorului și locație
            $distance = $location->distanceTo($request->latitude, $request->longitude);

            // Verifică dacă angajatul este în raza specificată pentru această locație
            if ($distance <= $location->radius && $distance < $minDistance) {
                $minDistance = $distance;
                $closestLocation = $location;
            }
        }

        // Dacă nu a fost găsită nicio locație validă pentru clock-out
        if (!$closestLocation) {
            return response()->json(['status' => 'error', 'message' => 'You are not at a valid location for clock-out.'], 400);
        }

        // Actualizăm înregistrarea de attendance cu ora de ieșire și locația
        $existingAttendance->update([
            'latitude_out' => $request->latitude,
            'longitude_out' => $request->longitude,
            'clock_out_time' => now(),  // Salvăm ora curentă ca ora de ieșire
        ]);
        // event(new AttendanceUpdated($existingAttendance));
        // Returnează un răspuns JSON
        return response()->json(['status' => 'success',
        'data' => [
            'attendance_id'=>$existingAttendance->id,
            'clock_out_time' => $existingAttendance->clock_out_time ? Carbon::parse($existingAttendance->clock_out_time)->format('H:i:s') : null // Ora de clock-out
        ] 
        ]);
    }
}
