<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
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
        return $user->hasRole('Super Admin'); // doar super adminii pot crea clienti
    }
    
    public function update(User $user, Client $client)
    {
        return false; // utilizatorii obișnuiți nu pot edita clienti
    }
    public function edit(User $user, Client $client)
    {
        return $user->hasRole('Super Admin');
    }

    public function delete(User $user, Client $client)
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, Client $client)
    {
        return $user->hasRole('Super Admin');
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Client $client): bool
    {
        //
    }
}
