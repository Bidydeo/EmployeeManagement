<?php

namespace App\Policies;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeavePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

     public function create(User $user)
    {
        //
    }
    
    public function update(User $user, Leave $leave)
    {
        return $user->employee && $user->employee->id === $leave->employee_id;
    }

    public function edit(User $user, Leave $leave)
    {
        return $user->employee && $user->employee->id === $leave->employee_id ||
                                    $user->employee->id === $leave->substitute_employee_id;
    }

    public function delete(User $user, Leave $leave)
    {
        return $user->employee && $user->employee->id === $leave->employee_id;
    }

    public function substituteApproval(User $user, Leave $leave)
    {
        return $user->employee && $leave->substitute_employee_id &&
        $user->employee->id === $leave->substitute_employee_id;
    }

    public function managerApproval(User $user, Leave $leave)
    {
        $leaveEmployee = $leave->employee;
        $department = $leaveEmployee?->department;

        return $user->employee && $department && $department->manager_id === $user->employee->id;
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Leave $leave): bool
    {
        //
    }
}
