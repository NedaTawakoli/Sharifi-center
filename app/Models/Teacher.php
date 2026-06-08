<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Salary;
use App\Models\Sinf;
class Teacher extends Model
{
    //
    protected $fillable = [
        'lastName',
        'phone_number',
        'tazkira_number',
        'image_url',
        'degree-of-education',
        'bio',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function salary(){
        return $this->hasMany(Salary::class);
    }
    public function sinf(){
        return $this->hasMany(Sinf::class);
    }
}
