<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['employee_id', 'date','location_id', 'clock_in_time', 'clock_out_time',
        'latitude_out', 'longitude_out', 'latitude_in', 'longitude_in'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
