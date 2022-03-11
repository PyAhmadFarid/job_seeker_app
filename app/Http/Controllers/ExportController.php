<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantExport;
use App\Exports\JobExport;
use App\Models\applicant;
use App\Models\job;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    function index(){
        if(auth()->user()->role == 0){
            $jobs = job::all();
            $users = User::all();
        }else{
            // dd(auth()->user()->id);
            $jobs = job::where('create_by','=',auth()->user()->id)->get();
            $users = null;
        }
        return view('admin.export',['jobs'=>$jobs,'users'=>$users]);
    }

    function export_data_applicants(Request $request){
        // dd($request);
        $jb = job::find($request->job_id);
        $cre = $request->validate([
            'job_id'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        if(auth()->user()->role == 1){
            if($jb->create_by != auth()->user()->id){
                return redirect()->back()->with('message','no job found');
            }
        }

        $applicants = applicant::whereBetween('created_at',[$request->from_date,$request->to_date])->where('job_id','=',$request->job_id)->get();
        
        if($applicants->count() < 1){
            return redirect()->back()->with('message','no data found');
        }

        $ex = new ApplicantExport($applicants);
        
        return Excel::download($ex ,$jb->title."_".$request->from_date."_".$request->to_date.'.xlsx');
        // dd($applicants);
    }

    function export_data_jobs(Request $request){
        // dd($request);
        // $jb = job::find($request->job_id);
        $cre = $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        if(auth()->user()->role == 0){
            if($request->create_by){
                $title = User::find($request->create_by)->name;
                $job = job::whereBetween('created_at',[$request->from_date,$request->to_date])->where('create_by','=',$request->create_by)->get();
            }else{
                $title = "all users";
                $job = job::whereBetween('created_at',[$request->from_date,$request->to_date])->get();
            }
        }else{
            $title = auth()->user()->name;
            $job = job::whereBetween('created_at',[$request->from_date,$request->to_date])->where('create_by','=',auth()->user()->id)->get();
        }


        $ex = new JobExport($job);
        return Excel::download($ex ,$title."_".$request->from_date."_".$request->to_date.'.xlsx');
        // dd($applicants);
    }
}
