<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Models\EmployerProfile;
use App\Models\User;
use App\Http\Requests\StoreEmployerProfileRequest;
use App\Http\Requests\UpdateEmployerProfileRequest;

class EmployerProfileController extends Controller
{

    public function profile($id)
    {
        $employer = User::find($id);
        $employer_profile = $employer->employer_profile;
        $industry = $employer_profile->industry->name;
        $country = $employer_profile->country->name;
        $city = empty($employer_profile->city) ? null : $employer_profile->city->name;
        $social_links  = $employer->employee_social_links;
        $data = [
            'employer' => $employer,
            'employer_profile' => $employer_profile ,
            'industry' => $industry ,
            'country' => $country ,
            'city' => $city ,
            'social_links' => $social_links ,
        ];

        return view('website.employer.profile', $data);
    }


}
