<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LocationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Location $location)
    {
        $user->employee->location->contains($location->id);
    }

    public function create(User $user)
    {
        return $user->hasRole('Super Admin');
    }

    public function update(User $user, Location $location)
    {
        return false;
    }
    public function edit(User $user, Location $location)
    {
        return $user->hasRole('Super Admin');
    }

    public function delete(User $user, Location $location)
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Location $location)
    {
        return $user->hasRole('Super Admin');
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Location $location): bool
    {
        //
    }
}
