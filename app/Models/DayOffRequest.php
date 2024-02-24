<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOffRequest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function attendance_code()
    {
        return $this->belongsTo(AttendanceCode::class);
    }
}
