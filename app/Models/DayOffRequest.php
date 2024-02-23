<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOffRequest extends Model
{
    use HasFactory;
    protected $fillable = ['attendance_code_id', 'start_date', 'end_date', 'photo', 'description', 'is_approved', 'approved_line_child', 'approved_line_parent'];

    public function attendance_code()
    {
        return $this->belongsTo(AttendanceCode::class);
    }
}
