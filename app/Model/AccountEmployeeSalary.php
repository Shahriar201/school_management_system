<?php

namespace App\Model;
use App\User;

use Illuminate\Database\Eloquent\Model;

class AccountEmployeeSalary extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
}
