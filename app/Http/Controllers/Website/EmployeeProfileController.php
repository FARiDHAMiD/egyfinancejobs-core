<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;
use App\Models\Experience;
use App\Models\CareerLevel;
use App\Models\JobType;
use App\Models\JobTitle;
use App\Models\JobCategory;
use App\Models\Industry;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\CertificateImage;
use App\Models\EducationLevel;
use App\Models\Education;
use App\Models\University;
use App\Models\User;
use App\Models\Skill;
use App\Models\EmployeeSkill;
use App\Models\SocialLink;
use App\Models\EmployeeAchievement;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class EmployeeProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->employee_profile == null) {
                return redirect()->route('employee.profile.create');
            }
            return $next($request);
        })->only([
            'edit_general_info',
            'update_general_info',
            'edit_career_inetrests',
            'update_career_inetrests',
            'edit_experiences',
            'update_experiences',
            'store_experiences',
            'destroy_experiences',
            'edit_educations',
            'update_educations',
            'store_educations',
            'destroy_educations',
            'edit_skills',
            'update_skills',
            'store_skills',
            'destroy_skills',
            'edit_online_presence',
            'update_online_presence',
            'edit_cv',
            'update_cv',
            'destroy_cv',
            'edit_achievements',
            'update_achievements',
            'edit_certificates',
            'update_certificates',
        ]);
    }

    public function view_profile($uuid = null)
    {
        if (auth()->check() && auth()->user()->hasRole('employee')) {
            // $employee = auth()->user();
            if ($uuid) {
                $employee = User::where('uuid', '=', $uuid)->firstOrFail();
            } else {
                $employee = auth()->user();
            }
        } else if ($uuid != null) {
            $employee = User::where('uuid', '=', $uuid)->firstOrFail();
        } else {
            return redirect()->route('website.home');
        }
        if ($employee->employee_profile == null) {
            session()->flash('alert_message', ['message' => 'Please, Complete your profile first!', 'icon' => 'danger']);
            return redirect()->route('employee.profile.create');
        }
        $data = [
            'page_name' => 'employee_profile',
            'page_title' => $employee->first_name . ' ' . $employee->last_name,
            'employee' => $employee,
            'profile' => $employee->employee_profile,
            'experiences' => $employee->employee_experiences,
            'educations' => $employee->employee_educations,
            'job_categories' => $employee->job_categories()->get(),
            'job_types' => $employee->job_types()->get(),
            'languages' => $employee->employee_skills('language'),
            'soft_skills' => $employee->employee_skills('soft'),
            'technical_skills' => $employee->employee_skills('technical'),
            'technology_skills' => $employee->employee_skills('technology'),
            'employee_achievements' => $employee->employee_achievements,
            'user_social_links' => $employee->user_social_links,
        ];

        return view('website.employee.profile.view-profile', $data);
    }

    public function create()
    {
        if (auth()->user()->employee_profile != '') {
            return redirect()->route('website.home');
        }
        $data = [
            'page_name' => 'employee_register',
            'page_title' => 'Register | Employee | Egy Finance',
            'career_levels' => CareerLevel::all(),
            'job_types' => JobType::all(),
            'job_titles' => JobTitle::orderBy('name')->get(),
            'job_categories' => JobCategory::orderBy('name')->get(),
            'industries' => Industry::orderBy('name')->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'universities' => University::all(),
            'education_levels' => EducationLevel::all(),
        ];

        return view('website.employee.profile.create', $data);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'career_level_id' => 'required|string|max:50',
            'open_job_type_ids' => 'required|array|min:1',
            'open_job_type_ids.*' => 'required|numeric|exists:job_types,id',
            'job_title_id' => 'required|string|max:50',
            'job_category_ids' => 'required|array|min:1',
            'job_category_ids.*' => 'required|numeric|exists:job_categories,id',
            'accepted_salary' => 'required|numeric|min:1|max:1000000',
            'birthdate' => [
                'required',
                'date',
                'before:' . Carbon::now()->subYears(18),
                'after:' . Carbon::now()->subYears(70),
            ],
            'gender' => 'required|in:male,female',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'numeric|exists:cities,id',
            'area_id' => 'numeric|exists:areas,id',
            'phone' => 'required|digits:11',

            'experience' => 'required|array|min:1',
            'experience.job_title' => 'required|string|max:255',
            'experience.company_name' => 'required|string|max:255',
            'experience.job_category_id' => 'required|numeric|exists:job_categories,id',
            'experience.company_industry_id' => 'required|numeric|exists:industries,id',
            'experience.job_type_id' => 'required|numeric|exists:job_types,id',
            'experience.starting_from' => [
                'required',
                'date',
                'before:' . Carbon::now(),
                'after:' . Carbon::create($request->birthdate)->addYears(14),
            ],
            'experience.ending_in' => 'nullable|required_without:experience.currently_work_there|date|after_or_equal:experience.starting_from',
            'experience.currently_work_there' => 'nullable|required_without:experience.ending_in|in:on',

            'education' => 'required|array|min:1',
            'education.education_level_id' => 'required',
            'education.degree_details' => 'required|max:255',
            'education.university_id' => 'required',
            'education.degree_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(6),
                'after:' . Carbon::create($request->birthdate)->addYears(16),
            ],
            'education.grade' => 'required',
            'education.certificate_image' => 'nullable|file|mimes:pdf',
        ]);



        $education = Education::create([
            'employee_id' => $user->id,
            'education_level_id' => $request->education['education_level_id'],
            'degree_details' => $request->education['degree_details'],
            'university_id' => $request->education['university_id'],
            'degree_date' => $request->education['degree_date'],
            'grade' => $request->education['grade'],
            'certificate_title' => $request->education['certificate_title'],
        ]);

        if ($request->has('education.certificate_image')) {
            $education->addMediaFromRequest('education.certificate_image')
                ->toMediaCollection('education_certificate');
        }



        Experience::create([
            'employee_id' => $user->id,
            'job_title' => $request->experience['job_title'],
            'company_name' => $request->experience['company_name'],
            'job_category_id' => $request->experience['job_category_id'],
            'company_industry_id' => $request->experience['company_industry_id'],
            'job_type_id' => $request->experience['job_type_id'],
            'currently_work_there' => $request->experience['ending_in'] != null ? 0 : (isset($request->experience['currently_work_there']) ? 1 : 0),
            'starting_from' => $request->experience['starting_from'],
            'ending_in' => $request->experience['ending_in'],
        ]);

        EmployeeProfile::create([
            'employee_id' => $user->id,
            'career_level_id' => $request->career_level_id,
            'job_title_id' => $request->job_title_id,
            'accepted_salary' => $request->accepted_salary,
            'show_salary' => isset($request->show_salary) ? 1 : 0,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'phone' => $request->phone,
        ]);

        foreach ($request->open_job_type_ids as $job_type_id) {
            $user->job_types()->attach($job_type_id, ['created_at' => now(), 'updated_at' => now()]);
        }
        foreach ($request->job_category_ids as $job_category_id) {
            $user->job_categories()->attach($job_category_id, ['created_at' => now(), 'updated_at' => now()]);
        }

        session()->flash('alert_message', ['message' => 'The profile has been created successfully', 'icon' => 'success']);
        return redirect()->route('website.home');
    }

    public function saved_jobs()
    {
        if (auth()->user()->employee_profile != '') {
            return redirect()->route('website.home');
        }
        $data = [
            'page_name' => 'employee_register',
            'page_title' => 'Register | Employee | Egy Finance',
            'career_levels' => CareerLevel::all(),
            'job_types' => JobType::all(),
            'job_titles' => JobTitle::all(),
            'job_categories' => JobCategory::all(),
            'industries' => Industry::all(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'universities' => University::all(),
            'education_levels' => EducationLevel::all(),
        ];
        return view('website.employee.jobs.create', $data);
    }

    public function edit_general_info()
    {
        $data = [
            'page_name' => 'edit_general_info',
            'page_title' => 'Edit General Info | Profile | Employee | Egy Finance',
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'employee' => auth()->user(),
            'profile' => auth()->user()->employee_profile,
        ];
        return view('website.employee.profile.edit-general-info', $data);
    }


    public function update_general_info(Request $request)
    {
        $employee = auth()->user();
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'bio' => 'max:250',
            'birthdate' => [
                'required',
                'date',
                'before:' . Carbon::now()->subYears(18),
                'after:' . Carbon::now()->subYears(80),
            ],

            'gender' => 'required|in:male,female',
            'marital_status' => 'required|in:unspecified,single,married',
            'military_status' => 'required|in:exempted,completed,postponed,not applicable',
            'country_id' => 'required|integer',
            'city_id' => 'integer',
            'area_id' => 'integer',
            'phone' => 'required|digits:11',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($employee->id)],
        ], [
            'first_name.required' => 'First Name is Required',
            'first_name.max' => 'Too long first name',
            'last_name.required' => 'Last Name is Required',
            'last_name.max' => 'Too long last name',
            'birthdate.before' => 'Age must be over 18 years old',
            'birthdate.after' => 'Age must be under 80 years old',
            'phone.digits' => 'Plese Enter Valid Phone Number',
        ]);


        User::find($employee->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);


        if ($request->has('profile_img')) {
            $file = $request->file('profile_img');
            $mime = $file->getMimeType();
            if (!in_array($mime, ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/svg+xml'])) {
                return back()->withErrors(['profile_img' => 'Invalid image format.']);
            }
            $request->validate(
                ['profile_img' => 'image|max:5000'],
                [
                    'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'profile_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );

            $employee->clearMediaCollection('employee_profile')
                ->addMediaFromRequest('profile_img')
                ->toMediaCollection('employee_profile');
        }


        EmployeeProfile::where('employee_id', $employee->id)->update([
            'bio' => $request->bio,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'military_status' => $request->military_status,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'phone' => $request->phone,
        ]);

        session()->flash('alert_message', ['message' => 'The general info has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function edit_career_inetrests()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_career_inetrests',
            'page_title' => 'Edit Career Inetrests | Profile | Employee | Egy Finance',
            'career_levels' => CareerLevel::all(),
            'job_types' => JobType::all(),
            'job_titles' => JobTitle::orderBy('name')->get(),
            'job_categories' => JobCategory::orderBy('name')->get(),
            'job_category_ids' => $employee->job_categories()->pluck('job_categories.id')->toArray(),
            'open_job_type_ids' => $employee->job_types()->pluck('job_types.id')->toArray(),
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-career-inetrests', $data);
    }


    public function update_career_inetrests(Request $request)
    {
        $employee = auth()->user();
        $request->validate(
            [
                'career_level_id' => 'required|string|max:50',
                'open_job_type_ids' => 'required|array|min:1',
                'open_job_type_ids.*' => 'required|numeric|exists:job_types,id',
                'job_title_id' => 'required|string|max:50',
                'job_category_ids' => 'required|array|min:1',
                'job_category_ids.*' => 'required|numeric|exists:job_categories,id',
                'accepted_salary' => 'required|numeric|min:1|max:1000000',
            ],
            [
                'accepted_salary.required' => 'Salary is required',
                'accepted_salary.mix' => 'Salary must be positive number',
                'accepted_salary.max' => 'Salary must be positive number under 1000000',
                'accepted_salary.numeric' => 'Salary must be positive number under 1000000',
            ]
        );


        EmployeeProfile::where('employee_id', $employee->id)->update([
            'career_level_id' => $request->career_level_id,
            'job_title_id' => $request->job_title_id,
            'accepted_salary' => $request->accepted_salary,
            'show_salary' => isset($request->show_salary) ? 1 : 0,
        ]);

        $employee->job_types()->detach();
        $employee->job_categories()->detach();

        foreach ($request->open_job_type_ids as $job_type_id) {
            $employee->job_types()->attach($job_type_id, ['created_at' => now(), 'updated_at' => now()]);
        }
        foreach ($request->job_category_ids as $job_category_id) {
            $employee->job_categories()->attach($job_category_id, ['created_at' => now(), 'updated_at' => now()]);
        }

        session()->flash('alert_message', ['message' => 'The career Interest has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function edit_experiences()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_experiences',
            'page_title' => 'Edit Experiences | Profile | Employee | Egy Finance',
            'job_categories' => JobCategory::orderBy('name')->get(),
            'industries' => Industry::orderBy('name')->get(),
            'job_types' => JobType::all(),
            'experiences' => $employee->employee_experiences,
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-experiences', $data);
    }


    public function update_experiences(Request $request, $experience_id)
    {
        $employee = auth()->user();
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_category_id' => 'required|numeric|exists:job_categories,id',
            'company_industry_id' => 'required|numeric|exists:industries,id',
            'job_type_id' => 'required|numeric|exists:job_types,id',
            'starting_from' => [
                'required',
                'date',
                'before:' . Carbon::now(),
                'after:' .  Carbon::create($employee->employee_profile->birthdate)->addYears(14),
            ],
            'ending_in' => 'nullable|required_without:currently_work_there|date|after_or_equal:starting_from',
            'currently_work_there' => 'nullable|required_without:ending_in|in:on',
        ], [
            'starting_from.required' => 'Enter Start Date',
            'starting_from.date' => 'Enter Valid Start Date',
            'starting_from.before' => 'Start Date must be in the past',
            'starting_from.after' => 'At least 14 years from your birthdate to add your first experience',

            'ending.required' => 'Enter End Date',
            'ending.date' => 'Enter Valid End Date',
            'ending.after_or_equal' => 'End Date must be after or equal Start date',
        ]);
        Experience::find($experience_id)->update([
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'job_category_id' => $request->job_category_id,
            'company_industry_id' => $request->company_industry_id,
            'job_type_id' => $request->job_type_id,
            'currently_work_there' => $request->ending_in != null ? 0 : (isset($request->currently_work_there) ? 1 : 0),
            'starting_from' => $request->starting_from,
            'ending_in' => $request->ending_in,
        ]);

        $employee = auth()->user();

        session()->flash('alert_message', ['message' => 'The general info has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function store_experiences(Request $request)
    {
        $employee = auth()->user();
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_category_id' => 'required|numeric|exists:job_categories,id',
            'company_industry_id' => 'required|numeric|exists:industries,id',
            'job_type_id' => 'required|numeric|exists:job_types,id',
            'starting_from' => [
                'required',
                'date',
                'before:' . Carbon::now(),
                'after:' .  Carbon::create($employee->employee_profile->birthdate)->addYears(14),
            ],
            'ending_in' => 'nullable|required_without:currently_work_there|date|after_or_equal:starting_from',
            'currently_work_there' => 'nullable|required_without:ending_in|in:on',
        ]);

        Experience::create([
            'employee_id' => $employee->id,
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'job_category_id' => $request->job_category_id,
            'company_industry_id' => $request->company_industry_id,
            'job_type_id' => $request->job_type_id,
            'currently_work_there' => $request->ending_in != null ? 0 : (isset($request->currently_work_there) ? 1 : 0),
            'starting_from' => $request->starting_from,
            'ending_in' => $request->ending_in,
        ]);

        session()->flash('alert_message', ['message' => 'The experience has been added successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy_experiences($experience_id)
    {
        $employee = auth()->user();
        $qs = Experience::WhereIn('employee_id', [$employee->employee_profile->employee_id])->distinct()->get()->count();
        // check if this is the last user/employee experience
        if ($qs <= 1) {
            session()->flash('alert_message', ['message' => 'At least one job experience is required!', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            Experience::find($experience_id)->delete();
            session()->flash('alert_message', ['message' => 'The experience has been deleted successfully', 'icon' => 'success']);
            return redirect()->back();
        }
    }


    public function edit_educations()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_educations',
            'page_title' => 'Edit Educations | Profile | Employee | Egy Finance',
            'universities' => University::all(),
            'education_levels' => EducationLevel::all(),
            'educations' => $employee->employee_educations,
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-educations', $data);
    }


    public function update_educations(Request $request, $education_id)
    {
        $employee = auth()->user();
        $request->validate([
            'education_level_id' => 'required',
            'degree_details' => 'required|max:100',
            'university_id' => 'required',
            'degree_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(6),
                'after:' .  Carbon::create($employee->employee_profile->birthdate)->addYears(16),
            ],
            'grade' => 'required',
            "certificate_image" => 'nullable|mimes:pdf',

        ]);
        $education = Education::find($education_id);


        if ($request->has('certificate_image')) {
            $education->clearMediaCollection('education_certificate')
                ->addMediaFromRequest('certificate_image')
                ->toMediaCollection('education_certificate');
        }


        Education::find($education_id)->update([
            'education_level_id' => $request->education_level_id,
            'degree_details' => $request->degree_details,
            'university_id' => $request->university_id,
            'degree_date' => $request->degree_date,
            'grade' => $request->grade,
            'certificate_title' => $request->certificate_title,
        ]);

        session()->flash('alert_message', ['message' => 'The education degree been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function store_educations(Request $request)
    {



        $employee = auth()->user();

        $request->validate([
            'education_level_id' => 'required',
            'degree_details' => 'required|max:100',
            'university_id' => 'required',
            'degree_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(6),
                'after:' . Carbon::create($employee->employee_profile->birthdate)->addYears(16),
            ],
            'grade' => 'required',
            'certificate_image' => 'nullable|file|mimes:pdf',
        ]);



        $education = Education::create([
            'employee_id' => $employee->id,
            'education_level_id' => $request->education_level_id,
            'certificate_title' => $request->certificate_title,
            'degree_details' => $request->degree_details,
            'university_id' => $request->university_id,
            'degree_date' => $request->degree_date,
            'grade' => $request->grade,
        ]);


        if ($request->has('certificate_image')) {
            $education->clearMediaCollection('education_certificate')
                ->addMediaFromRequest('certificate_image')
                ->toMediaCollection('education_certificate');
        }



        session()->flash('alert_message', ['message' => 'The education degree has been added successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy_educations($education_id)
    {
        $employee = auth()->user();
        $qs = Education::WhereIn('employee_id', [$employee->employee_profile->employee_id])->distinct()->get()->count();
        // check if this is the last user/employee education degree
        if ($qs <= 1) {
            session()->flash('alert_message', ['message' => 'At least one Education Degree is required!', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            Education::find($education_id)->delete();
            session()->flash('alert_message', ['message' => 'The education degree has been deleted successfully', 'icon' => 'success']);
            return redirect()->back();
        }
    }

    public function edit_skills()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_skills',
            'page_title' => 'Edit Skills | Profile | Employee | Egy Finance',
            'technical_skills' => Skill::where('category', 'technical')->orderBy('name'),
            'soft_skills' => Skill::where('category', 'soft')->orderBy('name'),
            'technology_skills' => Skill::where('category', 'technology')->orderBy('name'),
            'language_skills' => Skill::where('category', 'language')->orderBy('name'),
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-skills', $data);
    }


    public function update_skills(Request $request, $employee_skill_id)
    {
        $request->validate([
            'proficiency' => 'required|max:255',
        ]);
        EmployeeSkill::find($employee_skill_id)->update([
            'skill_level' => $request->proficiency
        ]);
        session()->flash('alert_message', ['message' => 'The skill been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function store_skills(Request $request)
    {
        $employee = auth()->user();
        $request->validate([
            'skill_category' => 'required|max:255',
            'skill_id' => 'required|max:255',
            'proficiency' => 'required|max:255',
        ]);

        EmployeeSkill::create([
            'employee_id' => $employee->id,
            'skill_id' => $request->skill_id,
            'skill_level' => $request->proficiency,
        ]);

        session()->flash('alert_message', ['message' => 'The skill has been added successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy_skills($employee_skill_id)
    {
        EmployeeSkill::find($employee_skill_id)->delete();
        session()->flash('alert_message', ['message' => 'The skill has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }



    public function edit_online_presence()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_online_presence',
            'page_title' => 'Edit Online Presence | Profile | Employee | Egy Finance',
            'employee' => $employee,
        ];
        return view('website.employee.profile.edit-online-presence', $data);
    }


    public function update_online_presence(Request $request)
    {
        $employee = auth()->user();

        $request->validate([
            'linkedIn' => 'nullable|string|max:255',
            'Facebook' => 'nullable|string|max:255',
            'YouTube' => 'nullable|string|max:255',
            'Website' => 'nullable|string|max:255',
            'Other' => 'nullable|string|max:255',
        ]);

        if ($employee->user_social_links != null) {
            SocialLink::where('user_id', $employee->id)->update([
                'linkedin' => $request->linkedIn,
                'facebook' => $request->Facebook,
                'youtube' => $request->YouTube,
                'website' => $request->Website,
                'other' => $request->Other,
            ]);
        } else {
            SocialLink::create([
                'user_id' => $employee->id,
                'linkedin' => $request->linkedIn,
                'facebook' => $request->Facebook,
                'youtube' => $request->YouTube,
                'website' => $request->Website,
                'other' => $request->Other,
            ]);
        }
        session()->flash('alert_message', ['message' => 'The social links has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function edit_cv()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_cv',
            'page_title' => 'Edit CV | Profile | Employee | Egy Finance',
            'employee' => $employee,
        ];
        return view('website.employee.profile.edit-cv', $data);
    }


    public function update_cv(Request $request)
    {
        $employee = auth()->user();

        $request->validate([
            'cv' => 'required|file|max:2048|mimes:pdf,xlsx,xls,doc,docx,png,jpg,jpeg,gif',
        ]);

        if ($request->has('cv')) {
            $employee->clearMediaCollection('employee_cv')
                ->addMediaFromRequest('cv')
                ->toMediaCollection('employee_cv');
        }

        session()->flash('alert_message', ['message' => 'The CV has been added successfully', 'icon' => 'success']);
        return redirect()->back();
    }
    public function destroy_cv($cv_id)
    {
        Media::find($cv_id)->delete();
        session()->flash('alert_message', ['message' => 'The CV has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function edit_achievements()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_achievements',
            'page_title' => 'Edit Achievements | Profile | Employee | Egy Finance',
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-achievements', $data);
    }


    public function update_achievements(Request $request)
    {
        $employee = auth()->user();
        $request->validate([
            'achievements' => 'required|string',
        ]);
        if ($employee->employee_achievements == null) {
            EmployeeAchievement::create([
                'employee_id' => $employee->id,
                'description' => $request->achievements
            ]);
            session()->flash('alert_message', ['message' => 'The achievements added successfully', 'icon' => 'success']);
        } else {
            EmployeeAchievement::where('employee_id', $employee->id)->update([
                'description' => $request->achievements
            ]);
            session()->flash('alert_message', ['message' => 'The achievements updated successfully', 'icon' => 'success']);
        }


        return redirect()->back();
    }

    public function edit_certificates()
    {
        $employee = auth()->user();
        $data = [
            'page_name' => 'edit_certificates',
            'page_title' => 'Edit certificates | Profile | Employee | Egy Finance',
            'employee' => $employee,
            'profile' => $employee->employee_profile,
        ];
        return view('website.employee.profile.edit-certificates', $data);
    }


    public function update_certificates(Request $request)
    {
        $employee = auth()->user();

        // Validate the uploaded files
        $request->validate([
            'certificates.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120', // Max 5MB
        ], [
            'certificates.*.mimes' => 'Only images, PDFs, and Word documents are allowed.',
            'certificates.*.max' => 'Each file must not exceed 5MB in size.',
        ]);

        // Process valid files
        foreach ($request->file('certificates') as $file) {
            $employee->addMedia($file)->toMediaCollection('employee_certificates');
        }

        session()->flash('alert_message', ['message' => 'The certificates updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }


    public function delete_certificates(Request $request, $id)
    {
        Media::find($id)->delete();
        session()->flash('alert_message', ['message' => 'The certificatefile deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function change_password_page()
    {
        $data = [
            'page_name' => 'change_password',
            'page_title' => 'Change Password | Profile | Employee | Egy Finance',
        ];
        if (auth()->user()->google_id) {
            return redirect()->back();
        }
        return view('website.employee.profile.change-password', $data);
    }
    public function change_password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $employee = auth()->user();
        if (!\Hash::check($request->old_password, $employee->password)) {
            session()->flash('alert_message', [
                'message' => 'The old password is incorrect.',
                'icon' => 'danger'
            ]);
            return redirect()->back();
        }
        $employee->password = \Hash::make($request->password);
        $employee->save();
        session()->flash('alert_message', [
            'message' => 'The password has been changed successfully.',
            'icon' => 'success'
        ]);

        return redirect()->back();
    }

    public function delete_account_page()
    {
        $data = [
            'page_name' => 'delete_account',
            'page_title' => 'Delete Account | Profile | Employee | Egy Finance',
        ];

        return view('website.employee.profile.delete-account', $data);
    }

    public function delete_account_post(Request $request)
    {
        $employee = auth()->user();
        if (!$employee->google_id) {
            $request->validate([
                'password' => 'required',
            ]);
        }

        // check if logged in with google account no need to provide password
        if (!$employee->google_id) {
            // Check if the old password matches the current password
            if (!\Hash::check($request->password, $employee->password)) {
                session()->flash('alert_message', [
                    'message' => 'The provided password is incorrect. Please try again.',
                    'icon' => 'danger'
                ]);
                return redirect()->back();
            }
        }

        // Soft-delete the user account
        $employee->delete();

        // Flash success message
        session()->flash('alert_message', [
            'message' => "Your account has been successfully deleted. We're sorry to see you go, but the door is always open! If you ever decide to come back, we'll be here to welcome you.",
            'icon' => 'success'
        ]);

        // Log the user out
        auth()->logout();

        return redirect()->route('website.home');
    }
}
