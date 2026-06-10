<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        "lastName",
        "phone_number",
        "tazkira_number",
        "image_url",
        "user_id",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sinf(){
        return $this->belongesToMany(Sinf::class,'sinf_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
