<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function child_structures()
    {
        return $this->hasMany(Structure::class);
    }
    public function user()
    {
        return $this->hasMany(Employee::class);
    }
}
