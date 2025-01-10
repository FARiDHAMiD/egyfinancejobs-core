<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Models\EmployerProfile;
use App\Models\User;
use App\Models\Job;
use App\Http\Requests\StoreEmployerProfileRequest;
use App\Http\Requests\UpdateEmployerProfileRequest;

class EmployerProfileController extends Controller
{

    public function profile($uuid)
    {
        // $employer = User::find($id);
        $employer = User::where('uuid', '=', $uuid)->firstOrFail();
        $emp_jobs = Job::where('employer_id', '=', $employer->id)->orderBy('created_at', 'desc')->get();
        $employer_profile = $employer->employer_profile;
        $industry = $employer_profile->industry->name;
        $country = $employer_profile->country->name;
        $city = empty($employer_profile->city) ? null : $employer_profile->city->name;
        $social_links  = $employer->employee_social_links;
        $data = [
            'page_title' => $employer->employer_profile->company_name,
            'employer' => $employer,
            'user' => null,
            'employer_profile' => $employer_profile,
            'industry' => $industry,
            'country' => $country,
            'city' => $city,
            'social_links' => $social_links,
            'emp_jobs' => $emp_jobs,
        ];

        return view('website.employer.profile', $data);
    }

    // same as previous function "profile" but using id instead of uuid
    public function employer_profile($id)
    {
        $employer = User::where('id', '=', $id)->firstOrFail();
        $emp_jobs = Job::where('employer_id', '=', $id)->orderBy('created_at', 'desc')->get();
        $employer_profile = $employer->employer_profile;
        $industry = $employer_profile->industry->name;
        $country = $employer_profile->country->name;
        $city = empty($employer_profile->city) ? null : $employer_profile->city->name;
        $social_links  = $employer->employee_social_links;
        $data = [
            'employer' => $employer,
            'user' => null,
            'employer_profile' => $employer_profile,
            'industry' => $industry,
            'country' => $country,
            'city' => $city,
            'social_links' => $social_links,
            'emp_jobs' => $emp_jobs,
        ];

        return view('website.employer.profile', $data);
    }
}
