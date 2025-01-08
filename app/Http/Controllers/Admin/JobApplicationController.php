<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationStatu;
use App\Models\EmployeeProfile;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use App\Notifications\EmployeeNotification;
use Illuminate\Http\Request;
use App\Mail\ApplicationStatuEmail;
use Illuminate\Support\Facades\Mail;

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
        $jobApplication->update(['status' => $request->status]);
        $admin = User::whereRoleIs('employee')->where('id', $jobApplication->employee_id)->first();
        if ($admin) {
            $job = Job::where('id', $jobApplication->job_id)->first();
            $title = "Your job application for $job->job_title updated to $request->status";
            $url =  route('employee.jobs.applications');
            $admin->notify(new EmployeeNotification($title, $url));
        }
        return 'done';
    }

    public function update_statu(Request $request, $id)
    {
        $jobApplication = JobApplication::find($id);
        $employee = User::where('id', $jobApplication->employee_id)->first();
        $job = Job::where('id', $jobApplication->job_id)->get();
        $company = $job[0]->employer_profile->company_name;
        $job_title = $job[0]->job_title;
        $new_statu = ApplicationStatu::find($request->statu_id)->name;
        $jobApplication->update([
            'statu_id' => $request->statu_id,
        ]);
        Mail::to($employee->email)->send(new ApplicationStatuEmail($employee, $company, $job_title, $new_statu));
        session()->flash('statu_changed', ['message' =>  $employee->first_name . ' ' . $employee->last_name . "'s application statu for " . $job_title . ' at' . ' ' . $company . ' has been changed to ' . $new_statu . ' successfully!', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        session()->flash('alert_message', ['message' => 'The application has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
