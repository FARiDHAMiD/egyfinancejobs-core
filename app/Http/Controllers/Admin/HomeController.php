<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUS;
use App\Models\ApplicationStatu;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = [];
        $applications = JobApplication::query();
        if ($request->has('employee_name') && $request->get('employee_name') != '') {
            $search['employee_name'] = $request->employee_name;
            $searchTerms = explode(' ', $request->employee_name);
            $applications->whereHas('employee', function ($query) use ($searchTerms) {
                $query->where(function ($subquery) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $subquery->Where('users.first_name', 'like', '%' . $term . '%')
                            ->orWhere('users.last_name', 'like', '%' . $term . '%');
                    }
                });
            });
        }
        if ($request->has('employee_phone') && $request->get('employee_phone') != '') {
            $search['employee_phone'] = $request->employee_phone;
            $searchTerms = $request->employee_phone;
            $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
                $query->Where('employee_profiles.phone', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('city') && $request->get('city') != '') {
            $search['city'] = $request->city;
            $searchTerms = $request->city;
            $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
                $query->Where('employee_profiles.city_id', $searchTerms);
            });
        }
        if ($request->has('university') && $request->get('university') != '') {
            $search['university'] = $request->university;
            $searchTerms = $request->university;
            $applications->whereHas('employee.employee_educations', function ($query) use ($searchTerms) {
                $query->Where('education.university_id', $searchTerms);
            });
        }
        if ($request->has('skill') && $request->get('skill') != '') {
            $search['skill'] = $request->skill;
            $search['skill_level'] = @$request->skill_level;
            $searchTerms = $request->skill;
            $searchTerms_l = $request->get('skill_level');
            $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
                if (!empty($searchTerms_l)) {
                    $query->Where('employee_skills.skill_id',  $searchTerms)->Where('employee_skills.skill_level',  $searchTerms_l);
                } else {
                    $query->Where('employee_skills.skill_id', $searchTerms);
                }
            });
        }
        if ($request->has('language') && $request->get('language') != '') {
            $search['language'] = $request->language;
            $search['language_level'] = @$request->language_level;
            $searchTerms = $request->language;
            $searchTerms_l = $request->get('language_level');
            $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
                if (!empty($searchTerms_l)) {
                    $query->Where('employee_skills.skill_id',  $searchTerms)->Where('employee_skills.skill_level',  $searchTerms);
                } else {
                    $query->Where('employee_skills.skill_id', $searchTerms);
                }
            });
        }
        if ($request->has('job') && $request->get('job') != '') {
            $search['job'] = $request->job;
            $searchTerms = $request->job;
            $applications->whereHas('job', function ($query) use ($searchTerms) {
                $query->Where('jobs.job_title', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('employer') && $request->get('employer') != '') {
            $searchTerms = $request->employer;
            $search['employer'] = $searchTerms;
            $applications->whereHas('job.employer_profile', function ($query) use ($searchTerms) {
                $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
                    ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('status') && $request->get('status') != '') {
            $searchTerms = $request->status;
            $search['status'] = $searchTerms;
            $applications->where('status', $searchTerms);
        }
        if ($request->has('app_id') && $request->get('app_id') != '') {
            $searchTerms = $request->app_id;
            $search['app_id'] = $searchTerms;
            $applications->where('id', $searchTerms);
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) && $request->has('to_date') && !empty($request->get('to_date'))) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            // Ensure `to_date` includes the end of the day
            $toDate = Carbon::parse($toDate)->endOfDay();
            $search['from_date'] = $fromDate;
            $search['to_date'] = $toDate;

            $applications->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $application_status = ApplicationStatu::all();
        $data = [
            'page_name' => 'home',
            'page_title' => 'Dashboard',
            'search' => $search,
            'status' => $application_status,
            'applications' => $applications->paginate(100),
        ];
        return view('admin.home', $data);
    }

    // public function index(Request $request){
    //     $search = [];
    //     $applications = JobApplication::latest();
    //     if ($request->has('employee_name') && $request->get('employee_name') != '') {
    //         $search['employee_name'] = $request->employee_name;
    //         $searchTerms = explode(' ', $request->employee_name);
    //         $applications->whereHas('employee', function ($query) use ($searchTerms) {
    //             $query->where(function ($subquery) use ($searchTerms) {
    //                 foreach ($searchTerms as $term) {
    //                     $subquery->orWhere('users.first_name', 'like', '%' . $term . '%')
    //                                 ->orWhere('users.last_name', 'like', '%' . $term . '%');
    //                 }
    //             });
    //         });
    //     }
    //     if ($request->has('employee_phone') && $request->get('employee_phone') != '') {
    //         $search['employee_phone'] = $request->employee_phone;
    //         $searchTerms = $request->employee_phone ;
    //         $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
    //             $query->orWhere('employee_profiles.phone', 'like', '%' . $searchTerms . '%');

    //         });
    //     }
    //     if ($request->has('city') && $request->get('city') != '') {
    //         $search['city'] = $request->city;
    //         $searchTerms = $request->city ;
    //         $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
    //             $query->orWhere('employee_profiles.city_id', 'like', '%' . $searchTerms . '%');
    //         });
    //     }
    //     if ($request->has('university') && $request->get('university') != '') {
    //         $search['university'] = $request->university;
    //         $searchTerms = $request->university ;
    //         $applications->whereHas('employee.employee_educations', function ($query) use ($searchTerms) {
    //             $query->orWhere('education.university_id', 'like', '%' . $searchTerms . '%');

    //         });
    //     }
    //     if ($request->has('skill') && $request->get('skill') != '') {
    //         $search['skill'] = $request->skill;
    //         $search['skill_level'] = @$request->skill_level;
    //         $searchTerms = $request->skill ;
    //         $searchTerms_l = $request->get('skill_level') ;
    //         $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
    //             if (!empty($searchTerms_l)) {
    //                 $query->Where('employee_skills.skill_id',  $searchTerms )->Where('employee_skills.skill_level',  $searchTerms );

    //             }else{
    //                 $query->Where('employee_skills.skill_id', 'like', '%' . $searchTerms . '%');
    //             }
    //         });
    //     }
    //     if ($request->has('language') && $request->get('language') != '') {
    //         $search['language'] = $request->language;
    //         $search['language_level'] = @$request->language_level;
    //         $searchTerms = $request->language ;
    //         $searchTerms_l = $request->get('language_level') ;
    //         $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
    //             if (!empty($searchTerms_l)) {
    //                 $query->Where('employee_skills.skill_id',  $searchTerms )->Where('employee_skills.skill_level',  $searchTerms );

    //             }else{
    //                 $query->Where('employee_skills.skill_id', 'like', '%' . $searchTerms . '%');
    //             }
    //         });
    //     }
    //     if ($request->has('job') && $request->get('job') != '') {
    //         $search['job'] = $request->job;
    //         $searchTerms = $request->job;
    //         $applications->whereHas('job', function ($query) use ($searchTerms) {
    //             $query->Where('jobs.job_title', 'like', '%' . $searchTerms . '%');

    //         });
    //     }
    //     if ($request->has('employer') && $request->get('employer') != '') {
    //         $searchTerms = $request->employer ;
    //         $search['employer'] = $searchTerms;
    //         $applications->whereHas('job.employer_profile', function ($query) use ($searchTerms) {
    //             $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
    //                         ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
    //         });
    //     }
    //     if ($request->has('status') && $request->get('status') != '') {
    //         $searchTerms = $request->status ;
    //         $search['status'] = $searchTerms;
    //         $applications->where('status', 'like', '%' . $searchTerms . '%');
    //     }
    //     if ($request->has('app_id') && $request->get('app_id') != '') {
    //         $searchTerms = $request->app_id ;
    //         $search['app_id'] = $searchTerms;
    //         $applications->where('id', $searchTerms);
    //     }
    //     if ($request->has('from_date') && !empty($request->get('from_date')) ) {
    //         $searchTerms = $request->from_date ;
    //         $search['from_date'] = $searchTerms;
    //         $applications->where('created_at', '>=', Carbon::parse($searchTerms) );
    //     }
    //     if ($request->has('to_date') && !empty($request->get('to_date')) ) {
    //         $searchTerms = $request->to_date ;
    //         $search['to_date'] = $searchTerms;
    //         $applications->where('created_at', '<=', Carbon::parse($searchTerms) );
    //     }

    //     $data = [
    //         'page_name' => 'home',
    //         'page_title' => 'Dashboard',
    //         'search' => $search,
    //         'applications' => $applications->paginate(10),
    //     ];
    //     return view('admin.home', $data);
    // }
    public function export_application(Request $request)
    {
        $search = [];
        $applications = JobApplication::query();
        if ($request->has('employee_name') && $request->get('employee_name') != '') {
            $search['employee_name'] = $request->employee_name;
            $searchTerms = explode(' ', $request->employee_name);
            $applications->whereHas('employee', function ($query) use ($searchTerms) {
                $query->where(function ($subquery) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $subquery->Where('users.first_name', 'like', '%' . $term . '%')
                            ->orWhere('users.last_name', 'like', '%' . $term . '%');
                    }
                });
            });
        }
        if ($request->has('employee_phone') && $request->get('employee_phone') != '') {
            $search['employee_phone'] = $request->employee_phone;
            $searchTerms = $request->employee_phone;
            $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
                $query->Where('employee_profiles.phone', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('city') && $request->get('city') != '') {
            $search['city'] = $request->city;
            $searchTerms = $request->city;
            $applications->whereHas('employee.employee_profile', function ($query) use ($searchTerms) {
                $query->Where('employee_profiles.city_id', $searchTerms);
            });
        }
        if ($request->has('university') && $request->get('university') != '') {
            $search['university'] = $request->university;
            $searchTerms = $request->university;
            $applications->whereHas('employee.employee_educations', function ($query) use ($searchTerms) {
                $query->Where('education.university_id', $searchTerms);
            });
        }
        if ($request->has('skill') && $request->get('skill') != '') {
            $search['skill'] = $request->skill;
            $search['skill_level'] = @$request->skill_level;
            $searchTerms = $request->skill;
            $searchTerms_l = $request->get('skill_level');
            $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
                if (!empty($searchTerms_l)) {
                    $query->Where('employee_skills.skill_id',  $searchTerms)->Where('employee_skills.skill_level',  $searchTerms);
                } else {
                    $query->Where('employee_skills.skill_id', $searchTerms);
                }
            });
        }
        if ($request->has('language') && $request->get('language') != '') {
            $search['language'] = $request->language;
            $search['language_level'] = @$request->language_level;
            $searchTerms = $request->language;
            $searchTerms_l = $request->get('language_level');
            $applications->whereHas('employee.employee_skills2', function ($query) use ($searchTerms) {
                if (!empty($searchTerms_l)) {
                    $query->Where('employee_skills.skill_id',  $searchTerms)->Where('employee_skills.skill_level',  $searchTerms);
                } else {
                    $query->Where('employee_skills.skill_id', $searchTerms);
                }
            });
        }
        if ($request->has('job') && $request->get('job') != '') {
            $search['job'] = $request->job;
            $searchTerms = $request->job;
            $applications->whereHas('job', function ($query) use ($searchTerms) {
                $query->Where('jobs.job_title', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('employer') && $request->get('employer') != '') {
            $searchTerms = $request->employer;
            $search['employer'] = $searchTerms;
            $applications->whereHas('job.employer_profile', function ($query) use ($searchTerms) {
                $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
                    ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('status') && $request->get('status') != '') {
            $searchTerms = $request->status;
            $search['status'] = $searchTerms;
            $applications->where('status', $searchTerms);
        }
        if ($request->has('app_id') && $request->get('app_id') != '') {
            $searchTerms = $request->app_id;
            $search['app_id'] = $searchTerms;
            $applications->where('id', $searchTerms);
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) && $request->has('to_date') && !empty($request->get('to_date'))) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            // Ensure `to_date` includes the end of the day
            $toDate = Carbon::parse($toDate)->endOfDay();
            $search['from_date'] = $fromDate;
            $search['to_date'] = $toDate;

            $applications->whereBetween('created_at', [$fromDate, $toDate]);
        }
        return (new FastExcel(export_jobApplication($applications->get())))->download('jopApplication.xlsx');
    }

    public function job_applications(Request $request)
    {
        $applications = JobApplication::latest();
        if ($request->has('employee_name')) {
            $searchTerms = explode(' ', $request->employee_name);
            $applications->whereHas('employee', function ($query) use ($searchTerms) {
                $query->where(function ($subquery) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $subquery->orWhere('users.first_name', 'like', '%' . $term . '%')
                            ->orWhere('users.last_name', 'like', '%' . $term . '%');
                    }
                });
            });
        }
        if ($request->has('employee_id')) {
            $applications->where('employee_id', $request->employee_id);
        }
        $data = [
            'page_name' => 'home',
            'page_title' => 'Dashboard',
            'applications' => $applications->paginate(10),
        ];
        return view('admin.job_applications', $data);
    }
    public function ReadNotification()
    {
        \DB::table('notifications')->where('id', request()->notify)->update(['read_at' => Carbon::now()]);
    }
    public function about_us()
    {
        $aboutSection = AboutUS::firstOrCreate(
            [],  // Conditions to find the record
            ['phone' => '01015891836']   // Attributes to create if not found
        );
        $data = [
            'page_name' => 'About_Company_social',
            'page_title' => 'about_company_social',
            'aboutSection' => $aboutSection,
        ];
        return view('admin.about_us', $data);
    }

    public function contact_us()
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return redirect()->back();
        } else {
            return view('website.contact');
        }
    }


    public function about_us_guest()
    {
        $about = AboutUS::firstOrFail();
        $data = [
            'page_name' => 'About Us | Egy Finance Jobs',
            'page_title' => 'About Us',
            'about' => $about,
        ];
        return view('website.about', $data);
    }
    public function about_us_update(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:100',
            'about_company' => 'required|string',
        ]);
        $data = $request->except('_token');
        $section = AboutUS::first();
        $section->update($data);
        session()->flash('alert_message', ['message' => 'data updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
