<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Location;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class, // Adaugă aici PermissionSeeder
            AdminPermissionSeeder::class, // Adaugă aici AdminPermissionSeeder
            // Poți adăuga și alte seedere
        ]);
        Company::factory(2)->create();
        Department::factory(5)->create();
        Employee::factory()->create([
            'company_id'=> '1',
            'department_id'=> '1',
            'employee_name'=> 'Super Admin',
            'employee_lastname'=>'Admin',
            'status'=> 'active',
            'email'=> 'admin@dev.neotechnik.ro',
        ]);
        Employee::factory()->create([
            'company_id'=> '1',
            'department_id'=> '1',
            'employee_name'=> 'Employee',
            'employee_lastname'=>'Employee',
            'status'=> 'active',
            'email'=> 'employee@dev.neotechnik.ro',
        ]);
        Employee::factory()->create([
            'company_id'=> '1',
            'department_id'=> '1',
            'employee_name'=> 'Manager',
            'employee_lastname'=>'Departament',
            'status'=> 'active',
            'email'=> 'manager@dev.neotechnik.ro',
        ]);
        Employee::factory()->create([
            'employee_name' => 'Razvan',
            'employee_lastname'=>'N',
            'email' => 'admin@dev.neotechnik.ro',
            'status' => 'active',
            'department_id' => 1,
            'company_id' => 1,
        ]);
        Employee::factory(5)->create();
        Department::all()->each(function ($department) {
            $department->update([
                'manager_id' => \Faker\Factory::create()->randomElement(Employee::pluck('id')->toArray()),
                ]);
            });
        User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'admin@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id'=>'1',
        ])->assignRole('Super Admin');
        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id'=>'2',
        ])->assignRole('Employee');
        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@dev.neotechnik.ro',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'employee_id'=>'3',
        ])->assignRole('Manager');
        //User::factory(5)->create();
        Location::factory(2)->create();
        Attendance::factory(4)->create();
        LeaveType::factory()->create([
            'name'=>'Concediu de odihna', 
            'max_days'=>'21',
        ]);
        LeaveType::factory()->create([
            'name'=> 'Concediu medical',
        ]);
        LeaveType::factory()->create([
            'name'=> 'Concediu fara plata',
        ]);
        LeaveType::factory()->create([
            'name'=> 'Concediu pentru studii',
            'max_days'=>'90',
        ]);
        Leave::factory(5)->create();
    }
}
