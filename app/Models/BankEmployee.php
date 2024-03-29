<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankEmployee extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'bank_id', 'account_number', 'account_holder_name', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
