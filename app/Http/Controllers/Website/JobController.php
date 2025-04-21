<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\CareerLevel;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\EmployerProfile;
use App\Models\JobApplication;
use App\Models\User;
use DB;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $selectedCountries = $request->input('country', []);
        $selectedCities = $request->input('city', []);
        $selectedAreas = $request->input('area', []);
        $selectedCareerLevels = $request->input('career_level', []);
        $selectedJobCategories = $request->input('job_category', []);
        $selectedJobTypes = $request->input('job_type', []);
        $selectedExperienceYearsFrom = $request->input('years_experience_from');
        $selectedExperienceYearsTo = $request->input('years_experience_to');
        $selectedPostedDate = $request->input('date_posted', []);
        $searchQuery = $request->input('search_field');

        // $jobsQuery = Job::latest(); 
        $jobsQuery = Job::where('archived', 0)->when(count($selectedCountries) > 0, function ($query) use ($selectedCountries) {
            return $query->whereIn('jobs.country_id', $selectedCountries)->latest();
        })
            ->when(count($selectedCities) > 0, function ($query) use ($selectedCities) {
                return $query->whereIn('jobs.city_id', $selectedCities)->latest();
            })
            ->when($request->city_id, function ($query) use ($request) {
                return $query->where('jobs.city_id', $request->city_id);
            })
            ->when(count($selectedAreas) > 0, function ($query) use ($selectedAreas) {
                return $query->whereIn('jobs.area_id', $selectedAreas)->latest();
            })
            ->when(count($selectedCareerLevels) > 0, function ($query) use ($selectedCareerLevels) {
                return $query->whereIn('jobs.career_level_id', $selectedCareerLevels)->latest();
            })
            ->when(count($selectedJobCategories) > 0, function ($query) use ($selectedJobCategories) {
                return $query->whereIn('jobs.category_id', $selectedJobCategories)->latest();
            })
            ->when(count($selectedJobTypes) > 0, function ($query) use ($selectedJobTypes) {
                return $query->whereIn('jobs.type_id', $selectedJobTypes)->latest();
            })
            ->when($selectedExperienceYearsFrom != null, function ($query) use ($selectedExperienceYearsFrom) {
                return $query->where('jobs.years_experience_from', '>=', $selectedExperienceYearsFrom)->latest();
            })
            ->when($selectedExperienceYearsTo != null, function ($query) use ($selectedExperienceYearsTo) {
                return $query->where('jobs.years_experience_to', '<=', $selectedExperienceYearsTo)->latest();
            })
            ->when(in_array('past_week', $selectedPostedDate), function ($query) {
                return $query->where('jobs.created_at', '>=', Carbon::now()->subWeek())->latest();
            })
            ->when(in_array('past_month', $selectedPostedDate), function ($query) {
                return $query->where('jobs.created_at', '>=', Carbon::now()->subMonth())->latest();
            })
            ->when($searchQuery != null, function ($query) use ($searchQuery) {
                return $query->where(function ($query) use ($searchQuery) {
                    $query->where('job_title', 'LIKE', "%$searchQuery%")
                        ->orWhere('job_description', 'LIKE', "%$searchQuery%")
                        ->orWhere('job_requirements', 'LIKE', "%$searchQuery%");
                })->latest();
            })->orderBy('featured', 'desc');

        // $qs = Job::join('cities', 'jobs.city_id', '=', 'cities.id')
        //     ->join('areas', 'jobs.area_id', '=', 'areas.id')
        //     ->join('job_categories', 'jobs.category_id', '=', 'job_categories.id')
        //     ->join('job_types', 'jobs.category_id', '=', 'job_types.id')
        //     ->select(
        //         'job_categories.name as Category',
        //         'job_types.name as Type',
        //         'jobs.job_title as Job Title',
        //         'jobs.job_description as Job Description',
        //         'jobs.job_requirements as Job Requirements',
        //         'cities.name as City',
        //         'areas.name as Area',
        //     )
        //     // ->orderBy('users.updated_at', 'desc')
        //     ->get();
        // return ($jobsQuery->get());


        // if (auth()->check() && auth()->user()->hasRole('employee') && auth()->user()->employee_profile != null) {
        //     $employee_profile = auth()->user()->employee_profile;
        //     $lat = empty($employee_profile->area) ? null : $employee_profile->area->lat;
        //     $lon = empty($employee_profile->area) ? null : $employee_profile->area->lon;
        //     $jobsQuery = $jobsQuery->select('jobs.*')
        //         ->join('areas', 'jobs.area_id', '=', 'areas.id')
        //         ->orderByRaw("SQRT(POWER(69.1 * (areas.lat - ?), 2) + POWER(69.1 * (? - areas.lon) * COS(areas.lat / 57.3), 2))", [$lat, $lon]);
        // } else {
        //     $jobsQuery = $jobsQuery->latest();
        // }
        $jobsQuery = $jobsQuery->latest();


        $all_jobs_ids = $jobsQuery->get('id');
        $jobs = $jobsQuery->paginate(50);


        $career_levels = CareerLevel::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();
        $job_types = JobType::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();
        $job_categories = JobCategory::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();
        $countries = Country::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();
        $cities = City::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();
        $areas = Area::withCount(['jobs' => function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        }])->whereHas('jobs', function ($query) use ($all_jobs_ids) {
            $query->whereIn('jobs.id', $all_jobs_ids->pluck('id'));
        })->orderBy('jobs_count', 'desc')->get();

        if ($jobs->count() < $all_jobs_ids->count()) {
            $filter = true;
        } else {
            $filter = false;
        }


        $data = [
            'page_name' => 'jobs',
            'page_title' => 'Jobs | Egy Finance',
            'career_levels' => $career_levels,
            'job_types' => $job_types,
            'job_categories' => $job_categories,
            'countries' => $countries,
            'cities' => $cities,
            'areas' => $areas,
            'jobs' => $jobs,
        ];
        return view('website.jobs.jobs', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $Job
     * @return \Illuminate\Http\Response
     */
    public function show($job_uuid)
    {
        $job = Job::where('job_uuid', '=', $job_uuid)->where('archived', 0)->firstOrFail();
        $job_applications = JobApplication::where('job_id', $job->id)->get();
        $employer = User::where('id', '=', $job->employer_id)->get();
        $similar_jobs = Job::where(['category_id' => $job->category_id, 'employer_id' => $job->employer_id])
            ->where('jobs.id', '!=', $job->id);
        if (auth()->check() && auth()->user()->hasRole('employee') && auth()->user()->employee_profile != null) {
            $employee_profile = auth()->user()->employee_profile;
            $lat = empty($employee_profile->area) ? null : $employee_profile->area->lat;
            $lon = empty($employee_profile->area) ? null : $employee_profile->area->lon;
            $similar_jobs = $similar_jobs->select('jobs.*')
                ->join('areas', 'jobs.area_id', '=', 'areas.id')
                ->orderByRaw("SQRT(POWER(69.1 * (areas.lat - ?), 2) + POWER(69.1 * (? - areas.lon) * COS(areas.lat / 57.3), 2))", [$lat, $lon]);
        } else {
            $similar_jobs =  $similar_jobs->latest();
        }
        $similar_jobs =  $similar_jobs->take(4)->get();

        $data = [
            'page_name' => 'job_details',
            'page_title' => $job->job_title,
            'job' => $job,
            'employer' => $employer,
            'job_applications' => $job_applications, // appear for admin only
            'similar_jobs' => $similar_jobs,
        ];

        return view('website.jobs.job-details', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $Job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $Job) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobRequest  $request
     * @param  \App\Models\Job  $Job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequest $request, Job $Job)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $Job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $Job)
    {
        //
    }
}
