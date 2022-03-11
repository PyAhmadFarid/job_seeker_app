<?php

namespace App\Http\Controllers;

use App\Models\applicant;
use Illuminate\Http\Request;
use App\Models\job;
use GuzzleHttp\Promise\Create;

class JobController extends Controller
{
    function index(){
        
        if(auth()->user()->role == 0){
            $jobs = Job::all();
        }else{
            // dd(auth()->user()->id);
            $jobs = Job::where('create_by','=',auth()->user()->id)->get();
        }
        return view('admin.jobs',["jobs"=>$jobs]);
    }

    function show_new_job(){
        

        return view('admin.new_jobs');
    }

    function save_new_job(Request $request){
        // dd(auth()->user()->id);
        $cre = $request->validate([
            "title" => "required",
            "desc" => "required",
            "salary"=>"numeric|nullable",
            "end_date"=>"required",
        ]);
        $cre['create_by'] = auth()->user()->id;
        $cre['status'] = $request->status?true:false;
        $newjob = Job::create($cre);
        $newjob->save();
        // dd($cre);
        return redirect()->route('jobs');
    }

    function delete_job($jobid){
        $job = job::findOrFail($jobid);
        $jobttl = $job->title;
        $job->delete();

        return redirect()->route('jobs')->with('message',$jobttl.' has been successfully deleted');
    }

    function show_edit_job($jobid){
        $job = Job::find($jobid);
        // dd($job);
        return view("admin.new_jobs",["job"=>$job]);
    }

    function save_edit_job(Request $request, $jobid){
        $job = Job::find($jobid);
        $cre = $request->validate([
            "title" => "required",
            "desc" => "required",
            "salary"=>"numeric|nullable",
            "end_date"=>"required",
            // "status"=>"required"
        ]);
        $job->status = $request->status?true:false;
        $job->fill($cre)->save();
        return redirect()->route('jobs')->with('message','job has been successfully edited');
    }


    function show_job_detail($jobid){
        $job = job::find($jobid);

        return view('job_detail',['job'=>$job]);
    }

    function show_job_form($jobid){
        // dd($jobid);
        $job = job::find($jobid);
        return view('job_form',['job'=>$job]);
    }

    function send_applicant_form(Request $request,$jobid){
        $cre = $request->validate([
            'full_name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'document'=>'required',
        ]);
        if($request->hasFile('document')){

            $filenameWithExt = $request->file('document')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('document')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('document')->storeAs('public/document',$fileNameToStore);

            $cre['document'] = $path;
            $cre['job_id'] = $jobid;
        }
        // dd($cre);
        applicant::Create($cre);

        return redirect()->route('home')->with('message','Application form has been successfully sent');
        // dd($request->file('document'));
        // $path = $request->file('document')->store('applicant_document');
        // $request->document->storeAs('images', 'aaa');
        // $applicant = applicant::create([

        // ]);
        
        

    }

}
