<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;



class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'page_name' => 'home',
            'page_title' => 'Egy Finance',
            'latest_companies' => User::whereRoleIs('employer')->withCount('employer_jobs')->orderByDesc('employer_jobs_count', 'asc')->take(10)->get(),
            // 'latest_jobs' => Job::where('city_id', '!=', 1)->latest()->take(8)->get(),
            'latest_jobs' => Job::latest()->take(8)->get(), // all cities
            'employers' => User::whereRoleIs('employer')->count(),
            'employee' => User::whereRoleIs('employee')->count(),
            'jobs' => Job::count(),
            // 'jobs_cairo' => Job::where('city_id', '1')->latest()->take(8)->get(), removed cairo jobs
            // 'jobs_cairo' => Job::where('city_id', '1')->latest()->take(8)->get(),

        ];

        return view('website.home', $data);
    }
}
