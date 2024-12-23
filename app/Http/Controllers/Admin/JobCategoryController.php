<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;

class JobCategoryController extends Controller
{

    public function index()
    {
        $rows = JobCategory::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'job-categories',
            'page_title' => 'Job Categories',
            'search' => $search,
            'job_categories' => $rows->get(),
        ];
        return view('admin.job_categories.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'job-categories',
            'page_title' => 'Create Job Categories',
        ];
        return view('admin.job_categories.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        JobCategory::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Category has been added successfully', 'icon' => 'success']);
        return redirect()->route('job-categories.index');
    }

    public function show(JobCategory $jobCategory)
    {
        //
    }

    public function edit(JobCategory $jobCategory)
    {
        $data = [
            'page_name' => 'job-categories',
            'page_title' => 'Edit Job Category | Locations',
            'job_category' => $jobCategory,
        ];
        return view('admin.job_categories.edit', $data);
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $jobCategory->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Job Category has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        session()->flash('alert_message', ['message' => 'The Job Category has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('job-categories.index');
    }
}
