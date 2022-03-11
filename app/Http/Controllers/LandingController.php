<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\job;

class LandingController extends Controller
{
    function index(Request $requset){
        // dd($requset->search);
        $search = $requset->search;
        $jobs= job::where('title','like','%'.$search.'%')->Where('status','=','1')->paginate(6);
        // dd($jobs);
        return view('landing',['jobs'=>$jobs]);
    }


}
