<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job1;
class Company extends Model
{
    //
    protected $fillable = [
        "name",
        "website",
        "Description",
        "logo"
    ];
    public function job(){
        return $this->hasMany(Job1::class);
    }
}
