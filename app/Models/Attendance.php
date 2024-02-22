<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['clock_in', 'clock_out', 'date', 'employee_id', 'late_clock_in', 'early_clock_out', 'location', 'shift_id'];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
