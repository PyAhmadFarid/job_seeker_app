<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index'])->name('jobs');
        Route::get('/new', [JobController::class, 'show_new_job'])->name('jobs.new');
        Route::post('/new', [JobController::class, 'save_new_job'])->name('jobs.new');
        Route::get('/edit/{jobid}', [JobController::class, 'show_edit_job'])->name('jobs.edit');
        Route::post('/edit/{jobid}', [JobController::class, 'save_edit_job'])->name('jobs.edit');
        Route::get('/delete/{jobid}', [JobController::class, 'delete_job'])->name('jobs.delete');
    });
    Route::prefix('applicants')->group(function () {
        Route::get('/', [ApplicantController::class, 'index'])->name('applicants');
        Route::middleware('role:0')->group(function () {
            Route::get('/edit/{applicantid}', [ApplicantController::class, 'show_edit_applicant'])->name('applicants.edit');
            Route::post('/edit/{applicantid}', [ApplicantController::class, 'save_edit_applicant'])->name('applicants.edit');
            Route::get('/delete/{applicantid}', [ApplicantController::class, 'delete_applicant'])->name('applicants.delete');
        });
    });

    Route::group(['prefix' => 'admins'], function () {
        Route::middleware('role:0')->group(function () {
            Route::get('/', [AdminsController::class, 'index'])->name('admins');
            Route::get('/new', [AdminsController::class, 'show_new_admin'])->name('admins.new');
            Route::post('/new', [AdminsController::class, 'save_new_admin'])->name('admins.new');
            Route::get('/delete/{userid}', [AdminsController::class, 'delete_admin'])->name('admins.delete');
        });
        Route::get('/edit/{userid}', [AdminsController::class, 'show_edit_admin'])->name('admins.edit');
        Route::post('/edit/{userid}', [AdminsController::class, 'save_edit_admin'])->name('admins.edit');
    });

    Route::group(['prefix'=>'export'],function(){
        Route::get('/',[ExportController::class,'index'])->name('export');
        Route::post('/exportApplicants',[ExportController::class,'export_data_applicants'])->name('export.applicants');
        Route::post('/exportJobs',[ExportController::class,'export_data_jobs'])->name('export.jobs');
    });
});

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/jobDetail/{jobid}', [JobController::class, 'show_job_detail'])->name('jobDetail');
Route::get('/jobForm/{jobid}', [JobController::class, 'show_job_form'])->name('jobForm');
Route::post('/jobForm/{jobid}', [JobController::class, 'send_applicant_form'])->name('jobForm');
Route::get('/about',function(){
    return view('about');
})->name('about');
// Route::get('/jobs', function () {
//     return view('admin.jobs');
// });
