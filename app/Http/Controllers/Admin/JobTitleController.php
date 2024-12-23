<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTitle;

class JobTitleController extends Controller
{
    public function index()
    {
        $rows = JobTitle::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'job-titles',
            'page_title' => 'Job Titles',
            'search' => $search,
            'job_titles' => $rows->get(),
        ];
        return view('admin.job_titles.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'job-titles',
            'page_title' => 'Create Job Titles',
        ];
        return view('admin.job_titles.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        JobTitle::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Title has been added successfully', 'icon' => 'success']);
        return redirect()->route('job-titles.index');
    }

    public function show(JobTitle $jobTitle)
    {
        //
    }


    public function edit(JobTitle $jobTitle)
    {
        $data = [
            'page_name' => 'job-titles',
            'page_title' => 'Edit Job Title | Locations',
            'job_title' => $jobTitle,
        ];
        return view('admin.job_titles.edit', $data);
    }

    public function update(Request $request, JobTitle $jobTitle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $jobTitle->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Title has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();
        session()->flash('alert_message', ['message' => 'The Job Title has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('job-titles.index');
    }
}
