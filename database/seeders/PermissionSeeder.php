<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions=[
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',  
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'employee_management_access',
            'employee_create',
            'employee_edit',
            'employee_show',
            'employee_delete',
            'employee_access',
            'attendance_management_access',
            'attendance_create',
            'attendance_edit',
            'attendance_show',
            'attendance_delete',
            'attendance_access',
            'leave_management_access',
            'leave_create',
            'leave_edit',
            'leave_show',
            'leave_delete',
            'leave_access',
        ];
        foreach ($permissions as $permission) {
            Permission::create(
                ['name' => $permission
            ]);
        }
        //gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'Employee']);
        $userpermission=[
            'employee_show',
            'attendance_create',
            'attendance_edit',
            'attendance_show',
            'attendance_access',
            'leave_create',
            'leave_edit',
            'leave_show',
            'leave_delete',
            'leave_access',
        ];
        foreach ($userpermission as $permission) {
            $role->givePermissionTo($permission);
        }

                $role = Role::create(['name' => 'Manager']);
        $userpermission=[
            'employee_show',
            'user_show',
            'attendance_create',
            'attendance_edit',
            'attendance_show',
            'attendance_delete',
            'attendance_access',
            'leave_create',
            'leave_edit',
            'leave_show',
            'leave_delete',
            'leave_access',
        ];
        foreach ($userpermission as $permission) {
            $role->givePermissionTo($permission);
        }

    }
}