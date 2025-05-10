<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Company $company)
    {
        return $user->companies->contains($company->id); // vezi doar companiile tale
    }

    public function create(User $user)
    {
        return $user->hasRole('Super Admin'); // doar super adminii pot crea companii
    }
    
    public function update(User $user, Company $company)
    {
        return false; // utilizatorii obișnuiți nu pot edita companii
    }
    public function edit(User $user, Company $company)
    {
        return $user->hasRole('Super Admin');
    }

    public function delete(User $user, Company $company)
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Company $company)
    {
        return $user->hasRole('Super Admin');
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        //
    }
}
