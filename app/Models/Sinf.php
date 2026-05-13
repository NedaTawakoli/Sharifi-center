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
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
