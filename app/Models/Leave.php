<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'leave_type_id', 'start_date', 'end_date',
    'substitute_employee_id','status','reason','manager_id'];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function substitute_employee()
    {
        return $this->belongsTo(Employee::class, 'substitute_employee_id');
    }
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }
}

