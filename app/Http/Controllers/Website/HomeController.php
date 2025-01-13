<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\EmployerProfile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;



class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'page_name' => 'home',
            'page_title' => 'Egy Finance Jobs   ',
            // make join employer with user to return featured value!
            // 'latest_companies' => User::whereRoleIs('employer')->join('employer_profiles', 'users.id', '=', 'employer_profiles.employer_id')->withCount('employer_jobs')->orderByDesc('employer_jobs_count', 'asc')->take(10)->get(),
            'featured_companies' => User::whereRoleIs('employer')
                ->join('employer_profiles', 'users.id', '=', 'employer_profiles.employer_id')
                ->select('users.*', 'employer_profiles.company_name', 'employer_profiles.company_industry_id')
                ->where('employer_profiles.featured', '=', 1)
                ->withCount('employer_jobs')->orderByDesc('employer_jobs_count', 'asc')
                ->take(10)
                ->get(),
            // 'latest_jobs' => Job::where('city_id', '!=', 1)->latest()->take(8)->get(),
            'latest_jobs' => Job::where('archived', 0)->latest()->take(8)->get(), // all cities
            'employers' => User::whereRoleIs('employer')->count(),
            'employee' => User::whereRoleIs('employee')->count(),
            'jobs' => Job::where('archived', 0)->count(),
            // 'jobs_cairo' => Job::where('city_id', '1')->latest()->take(8)->get(), removed cairo jobs
            // 'jobs_cairo' => Job::where('city_id', '1')->latest()->take(8)->get(),

        ];

        return view('website.home', $data);
    }
}
