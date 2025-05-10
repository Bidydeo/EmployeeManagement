<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'country',
        'company_ids',
    ];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    //adaugat acum
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function teams(): HasMany // Adăugat pentru echipe externe
    {
        return $this->hasMany(Team::class);
    }
}
