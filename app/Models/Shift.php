<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'time_in', 'time_out', 'status'];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
