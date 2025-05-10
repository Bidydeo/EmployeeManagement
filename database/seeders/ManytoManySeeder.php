<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Team;
use App\Models\Project;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ManyToManySeeder extends Seeder
{
 public function run(): void
{
    // 1. Fiecare proiect primește EXACT 2 echipe din compania lui
    Project::all()->each(function ($project) {
        // Găsește 2 echipe libere din compania proiectului
        $availableTeams = Team::where('company_id', $project->company_id)
            ->whereNull('project_id')
            ->inRandomOrder()
            ->take(2)
            ->get();

        foreach ($availableTeams as $team) {
            $team->project()->associate($project);
            $team->save();
        }
    });

    // 2. Fiecare echipă primește 2-3 angajați din aceeași companie
    Team::with('project')->get()->each(function ($team) {
        $companyId = $team->company_id;

        // Alege 2-3 angajați aleatoriu din compania echipei
        $employees = Employee::where('company_id', $companyId)
            ->inRandomOrder()
            ->take(rand(2, 3))
            ->pluck('id');

        // Adaugă angajații în echipă
        $team->employees()->syncWithoutDetaching($employees);
    });

    // 3. Asociază angajații cu locațiile proiectelor din echipele lor
    Employee::all()->each(function ($employee) {
        $projectIds = $employee->teams()->with('project:id')->get()
            ->pluck('project')->filter()->pluck('id')->unique();

        $locationIds = Location::where(function ($query) use ($employee, $projectIds) {
            $query->where('company_id', $employee->company_id)
                  ->orWhereIn('project_id', $projectIds);
        })->pluck('id');

        if ($locationIds->isNotEmpty()) {
            $employee->locations()->syncWithoutDetaching(
                $locationIds->random(1)
            );
        }
    });
}
}