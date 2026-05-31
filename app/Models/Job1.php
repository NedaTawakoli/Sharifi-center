<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Job_Details1;
class Job1 extends Model
{
    //
     protected $fillable = [
        'company_id',
        'title',
        'salary',
    ];

       public function company()
    {
        return $this->belongsTo(Company::class);
    }

       public function detail()
    {
        return $this->hasOne(Job_Details1::class);
    }
}
