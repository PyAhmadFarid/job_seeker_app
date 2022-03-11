<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    function Job(){
        return $this->belongsTo(Job::class,'job_id','id');
    }
}
