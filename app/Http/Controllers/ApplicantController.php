<?php

namespace App\Http\Controllers;

use App\Models\applicant;
use App\Models\job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    function index()
    {

        if (auth()->user()->role == 0) {
            $applicants = applicant::all();
        } else {
            $applicants = applicant::whereHas('job', function ($q) {
                // dd(auth()->user()->id);
                return $q->where('create_by', '=', auth()->user()->id);
            })->get();
        }

        return view('admin.applicants', ['applicants' => $applicants]);
    }

    function show_edit_applicant($applicantid)
    {
        $applicant = applicant::find($applicantid);

        $jobs = job::all();

        return view('admin.new_applicants', ['jobs' => $jobs, 'applicant' => $applicant]);
    }

    function save_edit_applicant(Request $request, $applicantid)
    {
        // dd($request);
        $cre = $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'job_id' => 'required'
        ]);

        $applicant = applicant::find($applicantid);

        if ($request->hasFile('document')) {

            $filenameWithExt = $request->file('document')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('document')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('document')->storeAs('public/document', $fileNameToStore);

            $cre['document'] = $path;

            Storage::delete($applicant->document);
        }

        $applicant->fill($cre)->save();

        return redirect()->route('applicants')->with('message', 'applicant has been succesfuly edited');
    }

    function delete_applicant($applicantid){
        $applicant = applicant::find($applicantid);
        Storage::delete($applicant->document);
        $applicant->delete();
        return redirect()->back()->with('message','applicant has been successfully deleted');
    }
}
