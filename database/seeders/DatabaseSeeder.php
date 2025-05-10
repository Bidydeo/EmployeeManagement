<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Leave;
use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use App\Models\Employee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\LeaveType;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Database\Seeders\ManytoManySeeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AdminPermissionSeeder::class,
        ]);
        // Crează 2 companii
    $companies = Company::factory(2)->create();

    // Crează o colecție de proiecte (în caz că ai nevoie de ea mai târziu)
    $projects = collect();

    // Parcurge fiecare companie
    foreach ($companies as $company) {
        // Crează un client pentru fiecare companie
        $clients = Client::factory(rand(1, 2))->create();

        // Leagă fiecare client de companie prin tabela pivot
        foreach ($clients as $client) {
            // Asociază clientul la companie
            $client->companies()->attach($company->id);

            // Crează proiectele pentru clientul respectiv
            $companyProjects = Project::factory(rand(1, 2))->create([
                'company_id' => $company->id,
                'client_id' => $client->id,
            ]);

            // Adaugă proiectele în colecția de proiecte
            $projects = $projects->merge($companyProjects);

        // $companies = Company::factory(2)->create();

        // $projects = collect();

        // foreach ($companies as $company) {
        //     $clients = Client::factory(rand(1, 1))->create([
        //         'company_id' => $company->id,
        //     ]);

        //     foreach ($clients as $client) {
        //         $companyProjects = Project::factory(rand(1, 2))->create([
        //             'company_id' => $company->id,
        //             'client_id' => $client->id,
        //         ]);
        //         $projects = $projects->merge($companyProjects);
            }
        }

        // Creează câte o locație pentru fiecare proiect
        $projects->each(function ($project) {
            Location::factory()->create([
                'company_id' => $project->company_id,
                'project_id' => $project->id,
            ]);
        });

        // Creează departamente
        Department::factory(3)->create();

        // Creează angajați de test
        Employee::factory()->create([
            'company_id' => 1,
            'department_id' => 1,
            'employee_name' => 'Super Admin',
            'employee_lastname' => 'Admin',
            'status' => 'active',
            'email' => 'admin@dev.neotechnik.ro',
        ]);

        Employee::factory()->create([
            'company_id' => 1,
            'department_id' => 1,
            'employee_name' => 'Employee',
            'employee_lastname' => 'Employee',
            'status' => 'active',
            'email' => 'employee@dev.neotechnik.ro',
        ]);

        Employee::factory()->create([
            'company_id' => 1,
            'department_id' => 1,
            'employee_name' => 'Manager',
            'employee_lastname' => 'Departament',
            'status' => 'active',
            'email' => 'manager@dev.neotechnik.ro',
        ]);

        Employee::factory()->create([
            'employee_name' => 'Razvan',
            'employee_lastname' => 'N',
            'email' => 'admin@dev.neotechnik.ro',
            'status' => 'active',
            'department_id' => 1,
            'company_id' => 1,
        ]);

        Employee::factory(3)->create();

        // Atribuie manageri la departamente
        Department::all()->each(function ($department) {
            $department->update([
                'manager_id' => \Faker\Factory::create()->randomElement(Employee::pluck('id')->toArray()),
            ]);
        });

        // Creează useri și atribuie roluri
        User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'admin@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id' => 1,
        ])->assignRole('Super Admin');

        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id' => 2,
        ])->assignRole('Employee');

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id' => 3,
        ])->assignRole('Manager');

        // Creează suficiente echipe pentru proiecte (minim 2 per proiect)
        foreach ($companies as $company) {
            // $companyProjectsCount = $projects->where('company_id', $company->id)->count();
            // Team::factory($companyProjectsCount * 2)->create([
            //     'company_id' => $company->id,
            // ]);
            $companyProjects = $projects->where('company_id', $company->id);

$companyProjects->each(function ($project) use ($company) {
    Team::factory(2)->create([
        'company_id' => $company->id,
        'project_id' => $project->id,
    ]);
});
        }

        $this->call(ManyToManySeeder::class);

        Attendance::factory(4)->create();

        LeaveType::factory()->create(['name' => 'Concediu de odihna', 'max_days' => 21]);
        LeaveType::factory()->create(['name' => 'Concediu medical']);
        LeaveType::factory()->create(['name' => 'Concediu fara plata']);
        LeaveType::factory()->create(['name' => 'Concediu pentru studii', 'max_days' => 90]);

        Leave::factory(5)->create();
    }
}
