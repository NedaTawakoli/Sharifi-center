<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Admin1 extends Model
{
    //
    protected $fillable = [
        "image_url",
        "lastName",
        "email",
        "user_id",
    ];
     public function user(){
        return $this->belongsTo(User::class);
    }
}
