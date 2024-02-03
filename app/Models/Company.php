<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'province',
        'city',
        'logo',
        'category',
        'class',
        'operating_permit_number',
    ];
}
