<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\JobCategory;
use App\Models\EducationLevel;
use App\Models\JobType;
use App\Models\CareerLevel;
use App\Models\Currency;
use App\Models\JobQuestion;
use App\Models\Skill;
use App\Models\JobApplication;
use App\Models\JobApplicationAnswer;
use App\Models\JobRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $search = [];
        $jobs = Job::orderBy('id', 'desc')->get();
        if ($request->has('job') && !empty($request->get('job'))) {
            $search['job'] = $request->job;
            $searchTerms = $request->job;
            $jobs->where('job_title', 'like', '%' . $searchTerms . '%');
        }
        if ($request->has('employer') && !empty($request->get('employer'))) {
            $searchTerms = $request->employer;
            $search['employer'] = $searchTerms;
            $jobs->whereHas('employer_profile', function ($query) use ($searchTerms) {
                $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
                    ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('salary') && !empty($request->get('salary'))) {
            $searchTerms = $request->salary;
            $search['salary'] = $searchTerms;
            $jobs->where('salary', 'like', '%' . $searchTerms . '%');
        }
        if ($request->has('job_category') && !empty($request->get('job_category'))) {
            $searchTerms = $request->job_category;
            $search['job_category'] = $searchTerms;
            $jobs->where('category_id', 'like', $searchTerms);
        }
        if ($request->has('type') && !empty($request->get('type'))) {
            $searchTerms = $request->type;
            $search['type'] = $searchTerms;
            $jobs->where('type_id', 'like', $searchTerms);
        }
        if ($request->has('from_date') && !empty($request->get('from_date'))) {
            $searchTerms = $request->from_date;
            $search['from_date'] = $searchTerms;
            $jobs->where('created_at', '>=', Carbon::parse($searchTerms));
        }
        if ($request->has('to_date') && !empty($request->get('to_date'))) {
            $searchTerms = $request->to_date;
            $search['to_date'] = $searchTerms;
            $jobs->where('created_at', '<=', Carbon::parse($searchTerms));
        }
        $data = [
            'page_name' => 'jobs',
            'page_title' => 'Jobs',
            'jobs' => $jobs,
            'job_categories' => JobCategory::all(),
            'types' => JobType::all(),
            'search' => $search,
        ];
        return view('admin.jobs.index', $data);
    }

    function job_request_create()
    {
        $cats = JobCategory::all();
        $types = JobType::all();
        $educations = EducationLevel::all();
        $career_levels = CareerLevel::all();
        $data = [
            'page_name' => 'Post Job Request',
            'page_title' => 'Post Job Request',
            'cats' => $cats,
            'types' => $types,
            'educations' => $educations,
            'career_levels' => $career_levels,
        ];

        return view('website.createJob', $data);
    }

    function job_request_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|string|max:30|min:2',
            'company' => 'required|string|max:30|min:2',
            'email' => 'required|email',
            'mobile' => 'nullable|digits:11',

            'title' => 'required|string|max:30|min:2',

            'excerpt' => 'nullable|string|max:100',
            'description' => 'required|string|max:1500|min:20',
            'requirements' => 'required|string|max:1500|min:20',
            'location' => 'required|string|max:500',
            'type_id' => 'required',
            'category_id' => 'required',
            'education_level_id' => 'required',
            'career_level_id' => 'required',
            'years_experience_from' => 'numeric|min:0|max:30',
            'years_experience_to' => 'numeric|gte:years_experience_from',
            'salary_from' => 'nullable|numeric|min:0',
            'salary_to' => 'nullable|numeric|gte:salary_from',
            // 'g-recaptcha-response' => 'recaptcha',
        ]);

        JobRequest::create([
            'username' => $request->username,
            'company' => $request->company,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'education_level_id' => $request->education_level_id,
            'career_level_id' => $request->career_level_id,
            'url_link' => $request->url_link,
            'salary_from' => $request->salary_from,
            'salary_to' => $request->salary_to,
            'years_experience_from' => $request->years_experience_from,
            'years_experience_to' => $request->years_experience_to,
            'questions' => $request->questions,
        ]);

        session()->flash('alert_message', ['message' => 'Your reuqest submitted successfully, We will notify you after review, Thank You!', 'icon' => 'success']);
        return redirect()->route('website.home');
    }

    function jobs_requests()
    {
        $jobs = JobRequest::all();
        $data = [
            'page_name' => 'Job Request',
            'page_title' => 'Job Request',
            'jobs' => $jobs,
        ];

        return view('admin.jobs.requests', $data);
    }

    function request_details($id)
    {
        $job = JobRequest::find($id);
        $data = [
            'page_name' => 'Job Request',
            'page_title' => 'Job Request',
            'job' => $job,
        ];

        return view('admin.jobs.request_details', $data);
    }

    function request_reviewed($job_id)
    {
        $job_request = JobRequest::find($job_id);
        $job_request->update([
            'pending' => 0,
            'reviewed_by' => Auth::id(),
        ]);
        session()->flash('alert_message', ['message' => 'The request has been reviewed successfully', 'icon' => 'success']);
        return redirect()->route('jobs.requests');
    }

    public function create()
    {
        $data = [
            'page_name' => 'jobs',
            'page_title' => 'Jobs',
            'employers' => User::latest()->whereHas('employer_profile')->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'job_categories' => JobCategory::all(),
            'education_levels' => EducationLevel::all(),
            'types' => JobType::all(),
            'career_levels' => CareerLevel::all(),
            'skills' => Skill::all(),
            'currencies' => Currency::all(),
        ];
        return view('admin.jobs.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer' => 'required|numeric|exists:users,id',
            'job_title' => 'required|string|max:255',
            'country' => 'required|numeric|exists:countries,id',
            'city' => 'required|numeric|exists:cities,id',
            'area' => 'required|numeric|exists:areas,id',
            'job_category' => 'required|numeric|exists:job_categories,id',
            'education_level' => 'required|numeric|exists:education_levels,id',
            'type' => 'required|numeric|exists:job_types,id',
            'career_level' => 'required|numeric|exists:career_levels,id',
            'job_description' => 'required|string|max:2500',
            'job_excerpt' => 'required|string|max:2500',
            'job_requirements' => 'required|string|max:2500',
            // 'job_skills' => 'required|array|min:1',
            'job_skills.*' => 'required|numeric|exists:skills,id',
            'years_experience_from' => 'numeric|min:0|max:30',
            'years_experience_to' => 'numeric|gte:years_experience_from',
            'salary_from' => 'nullable|numeric|min:0',
            'salary_to' => 'nullable|numeric|gte:salary_from',
        ]);

        $rules =  [
            'employer' => ['required'],
            'job_title' => [
                'required',
                Rule::unique('jobs', 'job_title')
                    ->where('employer_id', $request->employer)
            ]
        ];

        $message = [
            'job_title.unique' => 'same request submitted',
        ];

        // check unique together values (employer, job_title, city)
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('submit_anyway', ['message' => 'A job with very similar requirements have been already submitted', 'icon' => 'warning']);
            // return $request->all();
            return redirect()->back()->withInput();
        } else {
            // Create new job
            $job = Job::create([
                'employer_id' => $request->employer,
                'job_title' => $request->job_title,
                'country_id' => $request->country,
                'city_id' => $request->city,
                'area_id' => $request->area,
                'category_id' => $request->job_category,
                'education_level_id' => $request->education_level,
                'type_id' => $request->type,
                'career_level_id' => $request->career_level,
                'years_experience' => $request->years_experience,
                'salary' => $request->salary,
                'job_description' => $request->job_description,
                'job_excerpt' => $request->job_excerpt,
                'job_requirements' => $request->job_requirements,
                'external_url' => $request->get('external_url'),
                'external_email' => $request->get('external_email'),
                'featured' => $request->boolean(key: 'featured'),
                'currency_id' => $request->get('currency'),
                'years_experience_from' => $request->years_experience_from,
                'years_experience_to' => $request->years_experience_to,
                'salary_from' => $request->salary_from,
                'salary_to' => $request->salary_to,
                'net_gross' => $request->boolean(key: 'net_gross'),
                'user_id' => Auth::id(),
            ]);
        }



        if ($request->has('job_questions') && is_array($request->job_questions)) {
            foreach ($request->job_questions as $question) {
                if ($question['question'] != null) {
                    JobQuestion::create([
                        'job_id' => $job->id,
                        'question' => $question['question'],
                    ]);
                }
            }
        }

        if ($request->has('job_skills') && is_array($request->job_skills)) {
            foreach ($request->job_skills as $skill) {
                $job->skills()->attach($skill, ['created_at' => now(), 'updated_at' => now()]);
            }
        }

        session()->flash('alert_message', ['message' => 'The job has been added successfully', 'icon' => 'success']);
        return redirect()->route('jobs.index');
    }

    public function archive($job_id)
    {
        $job = Job::findOrFail($job_id);
        $job->update([
            'archived' => 1,
        ]);

        session()->flash('alert_message', ['message' => 'Job has been archived successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function reactivate($job_id)
    {
        $job = Job::findOrFail($job_id);
        $job->update([
            'archived' => 0,
        ]);
        session()->flash('alert_message', ['message' => 'Job has been reactivated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function force_submit(Request $request)
    {
        $job = new Job();
        $job->employer_id = request('employer_id');
        $job->job_title = request('job_title');
        $job->country_id = request('country_id');
        $job->city_id = request('city_id');
        $job->area_id = request('area_id');
        $job->category_id = request('category_id');
        $job->education_level_id = request('education_level_id');
        $job->type_id = request('type_id');
        $job->career_level_id = request('career_level_id');
        $job->job_description = request('job_description');
        $job->job_excerpt = request('job_excerpt');
        $job->job_requirements = request('job_requirements');
        $job->external_url = request('external_url');
        $job->external_email = request('external_email');
        $job->featured = request('featured');
        $job->currency_id = request('currency_id');
        $job->years_experience_from = request('years_experience_from');
        $job->years_experience_to = request('years_experience_to');
        $job->salary_from = request('salary_from');
        $job->salary_to = request('salary_to');
        $job->net_gross = request('net_gross') == 'on' ? 1 : 0;
        $job->user_id =  Auth::id();
        $job->save();

        // $job = Job::create([
        //     'employer_id' => $request->employer,
        //     'job_title' => $request->job_title,
        //     'country_id' => $request->country,
        //     'city_id' => $request->city,
        //     'area_id' => $request->area,
        //     'category_id' => $request->job_category,
        //     'education_level_id' => $request->education_level,
        //     'type_id' => $request->type,
        //     'career_level_id' => $request->career_level,
        //     'years_experience' => $request->years_experience,
        //     'salary' => $request->salary,
        //     'job_description' => $request->job_description,
        //     'job_excerpt' => $request->job_excerpt,
        //     'job_requirements' => $request->job_requirements,
        //     'external_url' => $request->get('external_url'),
        //     'external_email' => $request->get('external_email'),
        //     'featured' => $request->boolean(key: 'featured'),
        //     'currency_id' => $request->get('currency'),
        //     'years_experience_from' => $request->years_experience_from,
        //     'years_experience_to' => $request->years_experience_to,
        //     'salary_from' => $request->salary_from,
        //     'salary_to' => $request->salary_to,
        //     'net_gross' => $request->boolean(key: 'net_gross'),
        //     'user_id' => Auth::id(),
        // ]);


        // if ($request->has('job_questions') && is_array($request->job_questions)) {
        //     foreach ($request->job_questions as $question) {
        //         if ($question['question'] != null) {
        //             JobQuestion::create([
        //                 'job_id' => $job->id,
        //                 'question' => $question['question'],
        //             ]);
        //         }
        //     }
        // }

        // if ($request->has('job_skills') && is_array($request->job_skills)) {
        //     foreach ($request->job_skills as $skill) {
        //         $job->skills()->attach($skill, ['created_at' => now(), 'updated_at' => now()]);
        //     }
        // }

        session()->flash('alert_message', ['message' => 'New job added successfully, with very similar requirements', 'icon' => 'success']);
        return redirect()->route('jobs.index');
    }

    public function show(JobApplication $jobApplication)
    {
        //
    }

    public function edit(Job $job)
    {
        $data = [
            'page_name' => 'jobs',
            'page_title' => 'Edit Jobs',
            'job' =>  $job,
            'employers' => User::latest()->whereHas('employer_profile')->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'job_categories' => JobCategory::all(),
            'education_levels' => EducationLevel::all(),
            'types' => JobType::all(),
            'career_levels' => CareerLevel::all(),
            'skills' => Skill::all(),
            'currencies' => Currency::all(),
            'job_questions' => $job->questions,
            'job_skills' => $job->skills->pluck('id')->toArray(),
        ];
        return view('admin.jobs.edit', $data);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'employer' => 'required|numeric|exists:users,id',
            'job_title' => 'required|string|max:255',
            'country' => 'required|numeric|exists:countries,id',
            'city' => 'required|numeric|exists:cities,id',
            'area' => 'required|numeric|exists:areas,id',
            'job_category' => 'required|numeric|exists:job_categories,id',
            'education_level' => 'required|numeric|exists:education_levels,id',
            'type' => 'required|numeric|exists:job_types,id',
            'career_level' => 'required|numeric|exists:career_levels,id',
            'job_description' => 'required|string|max:2500',
            'job_excerpt' => 'required|string|max:2500',
            'job_requirements' => 'required|string|max:2500',
            // 'job_skills' => 'required|array|min:1',
            'job_skills.*' => 'required|numeric|exists:skills,id',
            'years_experience_from' => 'numeric|min:0|max:30',
            'years_experience_to' => 'numeric|gte:years_experience_from',
            'salary_from' => 'nullable|numeric|min:0',
            'salary_to' => 'nullable|numeric|gte:salary_from',
        ]);
        $job->update([
            'employer_id' => $request->employer,
            'job_title' => $request->job_title,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'area_id' => $request->area,
            'category_id' => $request->job_category,
            'education_level_id' => $request->education_level,
            'type_id' => $request->type,
            'career_level_id' => $request->career_level,
            'job_description' => $request->job_description,
            'job_excerpt' => $request->job_excerpt,
            'job_requirements' => $request->job_requirements,
            'external_url' => $request->get('external_url'),
            'external_email' => $request->get('external_email'),
            'featured' => $request->boolean(key: 'featured'),
            'currency_id' => $request->get('currency'),
            'years_experience_from' => $request->years_experience_from,
            'years_experience_to' => $request->years_experience_to,
            'salary_from' => $request->salary_from,
            'salary_to' => $request->salary_to,
            'net_gross' => $request->boolean(key: 'net_gross'),
        ]);

        $job->skills()->detach();
        JobQuestion::where('job_id', $job->id)->delete();

        if ($request->has('job_questions') && is_array($request->job_questions)) {
            foreach ($request->job_questions as $question) {
                JobQuestion::create([
                    'job_id' => $job->id,
                    'question' => $question['question'],
                ]);
            }
        }

        if ($request->has('job_skills') && is_array($request->job_skills)) {
            foreach ($request->job_skills as $skill) {
                $job->skills()->attach($skill, ['created_at' => now(), 'updated_at' => now()]);
            }
        }

        session()->flash('alert_message', ['message' => 'The job has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Job $job)
    {
        $job->skills()->detach();
        JobApplication::where('job_id', $job->id)->delete();
        JobApplicationAnswer::where('job_id', $job->id)->delete();
        JobQuestion::where('job_id', $job->id)->delete();
        Job::where('id', $job->id)->delete();
        session()->flash('alert_message', ['message' => 'The job has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
