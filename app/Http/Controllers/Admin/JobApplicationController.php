<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use App\Notifications\EmployeeNotification;
use Illuminate\Http\Request;


class JobApplicationController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(JobApplication $jobApplication)
    {
        //
    }

    public function edit(JobApplication $jobApplication)
    {
        //
    }

    public function update(Request $request,  $jobApplication)
    {
        $jobApplication = JobApplication::find($jobApplication);
        $jobApplication->update(['status'=> $request->status]);
        $admin = User::whereRoleIs('employee')->where('id', $jobApplication->employee_id)->first();
        if($admin){
            $job = Job::where('id', $jobApplication->job_id)->first();
            $title = "Your job application for $job->job_title updated to $request->status";
            $url =  route('employee.jobs.applications');
            $admin->notify( new EmployeeNotification($title, $url));
        }
        return 'done';
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        session()->flash('alert_message', ['message' => 'The application has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
