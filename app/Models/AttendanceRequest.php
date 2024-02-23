<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
