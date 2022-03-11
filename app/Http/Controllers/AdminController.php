<?php

namespace App\Http\Controllers;

use App\Models\applicant;
use App\Models\job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index()
    {
        //

        $year = now()->year;

        $jbs = job::whereYear('created_at', $year)->get();

        $ctb = array_fill(0,12,0);;
        foreach($jbs as $jb){
            $ctb[$jb->created_at->month]+=1;
        }
        $ctbr = json_encode($ctb);

        $aps = applicant::whereYear('created_at', $year)->get();

        $apbs = array_fill(0,12,0);;
        foreach($aps as $ap){
            $apbs[$ap->created_at->month]+=1;
        }
        $apbsr = json_encode($apbs);

        if (auth()->user()->role == 0) {
            $joball = job::all()->count();
            $jobactive = job::where('status', '=', '1')->count();
            $jobactivepercen = (int)(($joball / 100) * $jobactive);

            $applicantall = applicant::all()->count();


        } else {
            $uid = auth()->user()->id;
            $joball = job::where('create_by','=',$uid)->count();
            $jobactive = job::where('status', '=', '1')->where('create_by','=',$uid)->count();
            $jobactivepercen = (int)(($joball / 100) * $jobactive);

            $applicantall = applicant::whereHas('job',function($q){
                // dd(auth()->user()->id);
                return $q->where('create_by','=',auth()->user()->id);
            })->count();
        }

        $user = User::all()->count();
        $usersuper = User::where('role','=',0)->count();

        // dd();
        return view('admin.dashboard',['year'=>$year,'apbsr'=>$apbsr,'ctbr'=>$ctbr,'joball'=>$joball,'jobpercen'=>$jobactivepercen,'applicantall'=>$applicantall,'user'=>$user,'usersuper'=>$usersuper]);
    }
}
