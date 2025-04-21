<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseEnroll;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\User;

class ReportsController extends Controller
{
    function index()
    {
        $data = [
            'page' => 'main',
        ];
        return view('reports.index', $data);
    }

    function users()
    {
        $users = User::with(['roles', 'employee_profile', 'instructor_profile'])->get();
        $data = [
            'page' => 'users',
            'users' => $users,
        ];
        return view('reports.users', $data);
    }

    function jobs()
    {
        $jobs = Job::latest()->get();
        $cats = JobCategory::all();
        $data = [
            'page' => 'jobs',
            'jobs' => $jobs,
            'cats' => $cats,
        ];
        return view('reports.jobs', $data);
    }

    function employees()
    {
        $employees = User::whereRoleIs('employee');
        $data = [
            'page' => 'employees',
            'employees' => $employees->get(),
        ];
        return view('reports.employees', $data);
    }

    function employers()
    {
        $employers = User::whereRoleIs('employer');
        $admins = User::whereRoleIs('admin');
        $data = [
            'page' => 'employers',
            'employers' => $employers->latest()->get(),
            'admins' => $admins->latest()->get(),
        ];
        return view('reports.employers', $data);
    }

    function courses()
    {
        $courses = Course::latest()->get();
        $data = [
            'page' => 'courses',
            'courses' => $courses,
        ];
        return view('reports.courses', $data);
    }

    function apps()
    {
        $apps = JobApplication::latest()->get();
        $applications = JobApplication::with(['employee', 'job'])
            ->whereHas('job') // Ensures only applications with jobs are fetched
            ->orderBy('job_id') // Group by job
            ->get();
        // dd($applications);
        $data = [
            'page' => 'apps',
            'applications' => $applications,
            'apps' => $apps,
        ];
        return view('reports.apps', $data);
    }

    function instructors()
    {
        $instructors = User::whereRoleIs('instructor');
        // dd($instructors);
        $data = [
            'page' => 'instructors',
            'instructors' => $instructors->latest()->get(),
        ];
        return view('reports.instructors', $data);
    }

    function enrolls()
    {
        $enrolls = CourseEnroll::all();
        $students = User::with(['courses'])->whereHas('courses')->get();
        // dd($students);
        $data = [
            'page' => 'enrolls',
            'enrolls' => $enrolls,
            'students' => $students,
        ];
        return view('reports.enrolls', $data);
    }

    function advanced()
    {


        $data = [
            'page' => 'advanced',
        ];

        return view('reports.advanced', $data);
    }
}
