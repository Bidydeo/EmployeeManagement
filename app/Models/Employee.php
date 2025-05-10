<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use App\Models\Leave;
use App\Models\Company;
use App\Models\Location;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Project;

class Employee extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'company_id', 'department_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'employee_location', 'employee_id', 'location_id')->withTimestamps();
    }
    //adaugat azi
   // O echipă poate avea mai mulți angajați
    public function teams()
    {
        return $this->belongsToMany(Team::class,'employee_team');
    }

    // Toate proiectele la care un angajat este alocat (prin echipele la care face parte)
    public function projects()
    {
        return $this->teams()->with('project')->get()->pluck('project')->unique('id');
    }
}
