<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
            "company_name",
            "company_logo",
            "company_reg_com",
            "company_cui",
            "company_country",
            "company_town",
            "company_district",
            "company_street_name",
            "company_street_no",
            "company_email",
            "company_phone",
            "company_admin",
            "domeniu_email",
            'website',
            'iban',
            'bank',            
            'bank_address',
            'bank_city',            
            'bank_swift',   
        ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function locations() // Adăugat pentru locații permanente
    {
        return $this->hasMany(Location::class);
    }
    // asa am adaugat acum
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function clients(): BelongsToMany // Adăugat pentru relația opțională cu clienții
    {
        return $this->belongsToMany(Client::class);
    }

}
