<?php

namespace App\Models;
use App\Models\Job1;

use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    protected $fillable = [
        "start_date",
        "end_date",
        "description",
        "job_id",
    ];
    public function job(){
        return $this->belongsTo(Job1::class);
    }
}
