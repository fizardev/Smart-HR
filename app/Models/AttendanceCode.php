<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCode extends Model
{
    use HasFactory;
    protected $table = 'attendance_codes';
    protected $fillable = ['code', 'description'];

    public function day_off_requests()
    {
        $this->hasMany(DayOffRequest::class);
    }
}
