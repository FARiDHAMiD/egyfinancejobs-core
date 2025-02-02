<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobApplicationAnswer;
use App\Models\JobQuestion;
use App\Models\EmployerProfile;
use App\Models\PlanRequest;
use App\Models\Industry;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;



class EmployerController extends Controller
{

    public function index(Request $request)
    {
        $rows = User::whereRoleIs('employer')->latest();
        $search = [];
        if ($request->has('employer_name') && $request->get('employer_name') != '') {
            $search['employer_name'] = $request->employer_name;
            $searchTerms = explode(' ', $request->employer_name);
            $rows->where(function ($subquery) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $subquery->orWhere('users.first_name', 'like', '%' . $term . '%')
                        ->orWhere('users.last_name', 'like', '%' . $term . '%');
                }
            });
        }
        if ($request->has('employer_phone') && $request->get('employer_phone') != '') {
            $search['employer_phone'] = $request->employer_phone;
            $rows->whereHas('employer_profile', function ($query) use ($searchTerms) {
                $query->orWhere('employer_profiles.phone', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('employer') && $request->get('employer') != '') {
            $searchTerms = $request->employer;
            $search['employer'] = $searchTerms;
            $rows->whereHas('employer_profile', function ($query) use ($searchTerms) {
                $query->where('employer_profiles.company_name', 'like', '%' . $searchTerms . '%')
                    ->orWhere('employer_profiles.mobile_number', 'like', '%' . $searchTerms . '%');
            });
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) && $request->has('to_date') && !empty($request->get('to_date'))) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            // Ensure `to_date` includes the end of the day
            $toDate = Carbon::parse($toDate)->endOfDay();
            $search['from_date'] = $fromDate;
            $search['to_date'] = $toDate;

            $rows->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $data = [
            'page_name' => 'employers',
            'page_title' => 'Employers',
            'employers' => $rows->orderBy('id', 'desc')->get(),
            'search' => $search,
        ];
        return view('admin.employers.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'employers',
            'page_title' => 'Create Employer',
            'industries' => Industry::latest()->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
        ];
        return view('admin.employers.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'job_title' => 'max:255|string',
            'email' => 'nullable|string|email|max:255|unique:users',
            'mobile_number' => 'string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'company_size' => 'required|string|max:255',
            'company_industry' => 'required|numeric',
            'company_description' => 'required|string|max:2500',
            'country' => 'required|numeric|exists:countries,id',
            'city' => 'required|numeric|exists:cities,id',
            'area' => 'required|numeric|exists:areas,id',
        ]);

        // disable create employer temporary - will create employer name the same of company name
        $employer =  User::create([
            'first_name' => $request->company_name,
            'last_name' => $request->company_name,
            // 'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $employer->attachRole('employer');

        if ($request->has('company_logo')) {
            $request->validate(
                ['company_logo' => 'image|max:5000'],
                [
                    'company_logo.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'company_logo.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $employer->clearMediaCollection('company_logo');
            $employer->addMediaFromRequest('company_logo')
                ->toMediaCollection('company-logo');
        }

        if ($request->has('company_banner')) {
            $request->validate(
                ['company_banner' => 'image|max:5000'],
                [
                    'company_banner.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'company_banner.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $employer->clearMediaCollection('company_banner');
            $employer->addMediaFromRequest('company_banner')
                ->toMediaCollection('company_banner');
        }

        EmployerProfile::create([
            'employer_id' => $employer->id,
            // 'title' => $request->job_title,
            // 'mobile_number' => $request->mobile_number,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_industry_id' => $request->company_industry,
            'company_size' => $request->company_size,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'area_id' => $request->area,
            'area_id' => $request->area,
            'featured' => $request->boolean(key: 'featured'),
        ]);

        session()->flash('alert_message', ['message' => 'The employer has been created successfully', 'icon' => 'success']);
        return redirect()->route('employers.index');
    }


    public function show($id) {}

    public function edit($id)
    {
        $employer = User::find($id);
        $data = [
            'page_name' => 'employers',
            'page_title' => 'Edit Employer',
            'industries' => Industry::latest()->get(),
            'countries' => Country::all(),
            'cities' => City::all(),
            'areas' => Area::all(),
            'employer' => $employer,
            'employer_profile' => $employer->employer_profile,
        ];
        return view('admin.employers.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'job_title' => 'max:255|string',
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'mobile_number' => 'string|max:100',
            'company_name' => 'required|string|max:255',
            'company_size' => 'required|string|max:255',
            'company_industry' => 'required|numeric',
            'company_description' => 'required|string|max:2500',
            'country' => 'required|numeric|exists:countries,id',
            'city' => 'required|numeric|exists:cities,id',
            'area' => 'required|numeric|exists:areas,id',
        ]);


        $employer = User::find($id);


        if ($request->has('company_logo')) {
            $request->validate(
                ['company_logo' => 'image|max:5000'],
                [
                    'company_logo.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'company_logo.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $employer->clearMediaCollection('company_logo');
            $employer->addMediaFromRequest('company_logo')
                ->toMediaCollection('company_logo');
        }

        if ($request->has('company_banner')) {
            $request->validate(
                ['company_banner' => 'image|max:5000'],
                [
                    'company_banner.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'company_banner.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $employer->clearMediaCollection('company_banner');
            $employer->addMediaFromRequest('company_banner')
                ->toMediaCollection('company_banner');
        }


        $employer->update([
            'first_name' => $request->company_name,
            'last_name' => $request->company_name,
            'email' => $request->email,
        ]);



        EmployerProfile::where('employer_id', $id)->update([
            // 'title' => $request->job_title,
            // 'mobile_number' => $request->mobile_number,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_industry_id' => $request->company_industry,
            'company_size' => $request->company_size,
            'country_id' => $request->country,
            'city_id' => $request->city,
            'featured' => $request->boolean(key: 'featured'),
        ]);

        session()->flash('alert_message', ['message' => 'The employer has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy($id)
    {
        PlanRequest::where('employer_id', $id)->delete();
        $jobs = Job::where('employer_id', $id)->get();
        foreach ($jobs as $job) {
            JobApplication::where('job_id', $job->id)->delete();
            JobApplicationAnswer::where('job_id', $job->id)->delete();
            JobQuestion::where('job_id', $job->id)->delete();
        }
        Job::where('employer_id', $id)->delete();
        EmployerProfile::where('employer_id', $id)->delete();
        User::where('id', $id)->delete();
        session()->flash('alert_message', ['message' => 'The employer has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
