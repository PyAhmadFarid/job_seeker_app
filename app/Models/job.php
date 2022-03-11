<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\applicant;

class job extends Model
{
    protected $guarded = ['id']; 
    // protected $fillable = ['create_by','title','desc','salary','end_date'];
    use HasFactory;

    function Applicants(){
        return $this->hasMany(applicant::class,'job_id','id');
    }

    function User(){
        return $this->belongsTo(User::class,'create_by','id');
    }
}
