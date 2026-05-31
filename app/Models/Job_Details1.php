<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job1;
class Job_Details1 extends Model
{
    //

      protected $fillable = [
        'job_id',
        'description',
        'end_date',
        'start_date',
    ];


        public function job()
    {
        return $this->belongsTo(Job1::class);
    }

}
