<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobType;

class JobTypeController extends Controller
{

    public function index()
    {
        $rows = JobType::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'job-types',
            'page_title' => 'Job Types',
            'search' => $search,
            'job_types' => $rows->get(),
        ];
        return view('admin.job_types.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'job-types',
            'page_title' => 'Create Job Types',
        ];
        return view('admin.job_types.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        JobType::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Type has been added successfully', 'icon' => 'success']);
        return redirect()->route('job-types.index');
    }

    public function show(JobType $jobType)
    {
        //
    }

    public function edit(JobType $jobType)
    {
        $data = [
            'page_name' => 'job-types',
            'page_title' => 'Edit Job Type | Locations',
            'job_type' => $jobType,
        ];
        return view('admin.job_types.edit', $data);
    }

    public function update(Request $request, JobType $jobType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $jobType->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Type has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(JobType $jobType)
    {
        $jobType->delete();
        session()->flash('alert_message', ['message' => 'The Job Type has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('job-types.index');
    }
}
