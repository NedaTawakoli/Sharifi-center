<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Teacher;
class Sinf extends Model
{
    //
    public function payment(){
        return $this->hasMany(Payment::class);
    }
     public function student(){
        return $this->belongsToMany(Student::class,'student_id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
