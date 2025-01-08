<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Models\JobApplicationAnswer;
use App\Models\User;
use App\Notifications\AdminNotification;

class EmployeeJobController extends Controller
{
    public function saved_jobs()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'saved_jobs',
            'page_title' => 'saved jobs | jobs | Employee | Egy Finance',
            'saved_jobs' => $employee->saved_jobs->where('archived', 0),
        ];
        return view('website.employee.jobs.saved-jobs', $data);
    }

    public function save_job($job_id)
    {
        $user = auth()->user();
        $user->saved_jobs()->attach($job_id, ['created_at' => now(), 'updated_at' => now()]);
        session()->flash('alert_message', ['message' => 'The job has been saved successfully', 'icon' => 'success']);
        return redirect()->back();
    }
    public function unsave_job($job_id)
    {
        $user = auth()->user();
        $user->saved_jobs()->detach($job_id, ['created_at' => now(), 'updated_at' => now()]);
        session()->flash('alert_message', ['message' => 'The job has been unsaved', 'icon' => 'success']);
        return redirect()->back();
    }

    public function apply_job(Request $request, $job_id)
    {
        $job = Job::where('id', $job_id)->with('questions')->first();
        if (count($job->questions) > 0) {
            $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'required|string|max:255',
            ]);
        }

        $user = auth()->user();
        $user->applied_jobs()->attach($job_id, ['created_at' => now(), 'updated_at' => now(), 'statu_id' => 1]);
        $job_application = $user->job_applications()->where('job_id', $job_id)->first();
        if ($request->has('answers')) {
            foreach ($request->answers as $question_id => $answer) {
                JobApplicationAnswer::create([
                    'job_id' => $job_id,
                    'job_application_id' => $job_application->id,
                    'job_question_id' => $question_id,
                    'employee_id' => $user->id,
                    'answer' => $answer,
                ]);
            }
        }
        // notify Admin
        $admin = User::whereRoleIs('admin')->first();
        if ($admin) {
            $title = "$user->first_name applied for $job->job_title #$job_application->id";
            $url = route('admin-mark-notification-as_readed');
            $admin->notify(new AdminNotification($title, $url));
        }
        session()->flash('alert_message', ['message' => 'The job has been applied successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function applications()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'applications',
            'page_title' => 'applications | jobs | Employee | Egy Finance',
            'applications' => $employee->applications,
            'applications_count' => $employee->applied_jobs()->where('archived', 0)->count(),
        ];
        if (request()->has('notify')) {
            $employee->notifications->where('id', request()->notify)->markAsRead();
        }
        return view('website.employee.jobs.applications', $data);
    }

    public function destroy_application($id)
    {
        // dd($id);
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplicationAnswers = JobApplicationAnswer::where('job_application_id', $id)->get();

        // Delete Multiple answers associated with this user
        JobApplicationAnswer::destroy($jobApplicationAnswers);

        // Delete job application
        $jobApplication->delete();
        session()->flash('alert_message', ['message' => 'The application has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
