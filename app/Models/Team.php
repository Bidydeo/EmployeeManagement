<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
     use HasFactory; // Folosește HasFactory
     public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client(): BelongsTo // Adăugat pentru echipe externe
    {
        return $this->belongsTo(Client::class);
    }

    // Echipa are mai mulți angajați
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_team');
    }
}
