<?php

namespace App\Models;

use App\Models\File;
use App\Models\Team;
use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'client_id',
        'slug',
        'company_id',
        'team_id',
        'description',
        'projectleader',
        'status',
        'progress',
        'budget',
        'spending',
        'duration',
    ];
    // public function teams()
    // {
    //     return $this->belongsToMany(Team::class,'team_projects');
    // }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    //adaugat azi
    public function location(): HasOne // Adăugat: fiecare proiect are o locație (șantier)
    {
        return $this->hasOne(Location::class);
    }

    // Proiectul are mai multe echipe
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    // Toți angajații asociați proiectului (prin echipele proiectului)
    public function employees()
    {
        return $this->teams->flatMap(function ($team) {
            return $team->employees;
        })->unique('id');
    }
}
