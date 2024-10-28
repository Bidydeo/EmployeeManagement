<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        return $this->belongsToMany(Location::class, 'employee_location', 'employee_id', 'location_id');
    }
}
