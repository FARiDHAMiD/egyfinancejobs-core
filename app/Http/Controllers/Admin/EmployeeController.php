<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;
use App\Models\JobApplication;
use App\Models\JobQuestion;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $rows = User::whereRoleIs('employee')->latest();
        $search = [];
        if ($request->has('employee_name') && $request->get('employee_name') != '') {
            $search['employee_name'] = $request->employee_name;
            $searchTerms = explode(' ', $request->employee_name);
            $rows->where(function ($subquery) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $subquery->orWhere('users.first_name', 'like', '%' . $term . '%')
                        ->orWhere('users.last_name', 'like', '%' . $term . '%')
                        ->orWhere('users.email', 'like', '%' . $term . '%');
                }
            });
        }
        if ($request->has('employee_phone') && $request->get('employee_phone') != '') {
            $search['employee_phone'] = $request->employee_phone;
            $rows->whereHas('employee_profile', function ($query) use ($searchTerms) {
                $query->orWhere('employee_profiles.phone', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) && $request->has('to_date') && !empty($request->get('to_date'))) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            // Ensure `to_date` includes the end of the day
            $toDate = Carbon::parse($toDate)->endOfDay();
            $search['from_date'] = $fromDate;
            $search['to_date'] = $toDate;

            $rows->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $data = [
            'page_name' => 'employees',
            'page_title' => 'Employees',
            'employees' => $rows->get(),
            'search' => $search,
        ];
        return view('admin.employees.index', $data);
    }

    // view employee applications as Admin!
    public function employee_applications($id)
    {
        $employee = User::find($id);
        $data = [
            'page_name' => 'applications',
            'page_title' => 'applications | jobs | Employee | Egy Finance',
            'employee' => $employee,
            'applications' => $employee->applications,
            'applications_count' => $employee->applied_jobs()->where('archived', 0)->count(),
        ];
        if (request()->has('notify')) {
            $employee->notifications->where('id', request()->notify)->markAsRead();
        }
        return view('website.employee.jobs.applications', $data);
    }

    // Employee application asnwers by app_id and emp_id use in job-details page
    public function employee_applications_answers($app_id, $emp_id)
    {
        $employee = User::find($emp_id);
        $application = JobApplication::where('employee_id', $emp_id)
            ->where('id', $app_id)
            ->first();
        $data = [
            'page_name' => 'Application Answers',
            'employee' => $employee,
            'application' => $application,
        ];

        // $question = JobQuestion::find($application->application_answers[0]->job_question_id);
        // dd($question->question, $application->application_answers[0]->answer);
        // $data = [
        //     'employee' => $employee,
        // ];
        return view('website.employee.jobs.app_answers', $data);
    }
}
