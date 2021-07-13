<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class StudentMarks extends Model
{
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
