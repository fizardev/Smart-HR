<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bank_employee()
    {
        return $this->hasOne(BankEmployee::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function jobLevel()
    {
        return $this->belongsTo(JobLevel::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function day_off_requests()
    {
        return $this->hasMany(DayOffRequest::class);
    }
    public function attendance_requests()
    {
        return $this->hasMany(AttendanceRequest::class);
    }
}
