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
use App\Models\JobQuestion;
use App\Models\Skill;
use App\Models\JobApplication;
use App\Models\JobApplicationAnswer;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $search = [];
        $jobs = Job::latest();
        if ($request->has('job') && !empty($request->get('job')) ) {
            $search['job'] = $request->job;
            $searchTerms = $request->job;
            $jobs->where('job_title', 'like', '%' . $searchTerms . '%');
        }
        if ($request->has('employer') && !empty($request->get('employer')) ) {
            $searchTerms = $request->employer ;
            $search['employer'] = $searchTerms;
            $jobs->whereHas('employer_profile', function ($query) use ($searchTerms) {
                $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
                            ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('salary') && !empty($request->get('salary')) ) {
            $searchTerms = $request->salary ;
            $search['salary'] = $searchTerms;
            $jobs->where('salary', 'like', '%' . $searchTerms . '%');
        }
        if ($request->has('job_category') && !empty($request->get('job_category')) ) {
            $searchTerms = $request->job_category ;
            $search['job_category'] = $searchTerms;
            $jobs->where('category_id', 'like', $searchTerms );
        }
        if ($request->has('type') && !empty($request->get('type')) ) {
            $searchTerms = $request->type ;
            $search['type'] = $searchTerms;
            $jobs->where('type_id', 'like', $searchTerms );
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) ) {
            $searchTerms = $request->from_date ;
            $search['from_date'] = $searchTerms;
            $jobs->where('created_at', '>=', Carbon::parse($searchTerms) );
        }
        if ($request->has('to_date') && !empty($request->get('to_date')) ) {
            $searchTerms = $request->to_date ;
            $search['to_date'] = $searchTerms;
            $jobs->where('created_at', '<=', Carbon::parse($searchTerms) );
        }
        // return $jobs->paginate(10);
        $data = [
            'page_name' => 'jobs',
            'page_title' => 'Jobs',
            'jobs' => $jobs->paginate(10),
            'job_categories' => JobCategory::all(),
            'types' => JobType::all(),
            'search' => $search,
        ];
        return view('admin.jobs.index', $data);
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
            'years_experience' => 'required|numeric',
            'salary' => 'required|numeric',
            'job_description' => 'required|string|max:2500',
            'job_excerpt' => 'required|string|max:2500',
            'job_requirements' => 'required|string|max:2500',
            'job_skills' => 'required|array|min:1',
            'job_skills.*' => 'required|numeric|exists:skills,id',
        ]);
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
        ]);

        

        if($request->has('job_questions') && is_array($request->job_questions)){
            foreach($request->job_questions as $question){
                JobQuestion::create([
                    'job_id' => $job->id,
                    'question' => $question['question'],
                ]);
            }
        }

        if($request->has('job_skills') && is_array($request->job_skills)){
            foreach($request->job_skills as $skill){
                $job->skills()->attach($skill, ['created_at' => now(), 'updated_at' => now()]);
            }
        }

        session()->flash('alert_message', ['message' => 'The job has been added successfully', 'icon' => 'success']);
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
            'employers' => User::latest()->with('employer_profile')->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'job_categories' => JobCategory::all(),
            'education_levels' => EducationLevel::all(),
            'types' => JobType::all(),
            'career_levels' => CareerLevel::all(),
            'skills' => Skill::all(),
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
            'years_experience' => 'required|numeric',
            'salary' => 'required|numeric',
            'job_description' => 'required|string|max:2500',
            'job_excerpt' => 'required|string|max:2500',
            'job_requirements' => 'required|string|max:2500',
            'job_skills' => 'required|array|min:1',
            'job_skills.*' => 'required|numeric|exists:skills,id',
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
            'years_experience' => $request->years_experience,
            'salary' => $request->salary,
            'job_description' => $request->job_description,
            'job_excerpt' => $request->job_excerpt,
            'job_requirements' => $request->job_requirements,
            'external_url' => $request->get('external_url'),
            'external_email' => $request->get('external_email'),
        ]);

        $job->skills()->detach();
        JobQuestion::where('job_id', $job->id)->delete();

        if($request->has('job_questions') && is_array($request->job_questions)){
            foreach($request->job_questions as $question){
                JobQuestion::create([
                    'job_id' => $job->id,
                    'question' => $question['question'],
                ]);
            }
        }

        if($request->has('job_skills') && is_array($request->job_skills)){
            foreach($request->job_skills as $skill){
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
        Job::where('id' , $job->id)->delete();
        session()->flash('alert_message', ['message' => 'The job has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
