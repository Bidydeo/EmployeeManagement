<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'latitude', 'longitude', 'radius', 'company_id','project_id'];

    public function company() // Adăugat pentru locațiile permanente
    {
        return $this->belongsTo(Company::class);
    }
// adaugat azi 
    public function project(): BelongsTo // Adăugat pentru locațiile de șantier
    {
        return $this->belongsTo(Project::class);
    }
    public function getLocationTypeAttribute(): string // Accessor adăugat pentru tipul locației
    {
        return match ($this->type) {
            'birou' => 'Birou Central',
            'santier' => 'Șantier',
            'depozit' => 'Depozit',
            default => 'Necunoscut',
        };
    }
// pana aici adaugat azi
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_location', 'location_id', 'employee_id')->withTimestamps();
    }
    public function distanceTo($latitude, $longitude)
    {
        $earthRadius = 6371; // Raza Pământului în kilometri

        $latFrom = deg2rad($latitude);
        $lonFrom = deg2rad($longitude);

        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distanța în kilometri

        return $distance;
    }       
}
