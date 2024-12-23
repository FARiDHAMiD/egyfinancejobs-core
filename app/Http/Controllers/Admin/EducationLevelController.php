<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationLevel;

class EducationLevelController extends Controller
{
    public function index()
    {
        $rows = EducationLevel::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'education-levels',
            'page_title' => 'Education Levels',
            'search' => $search,
            'education_levels' => $rows->get(),
        ];
        return view('admin.education_levels.index', $data);
    }
    public function create()
    {
        $data = [
            'page_name' => 'education-levels',
            'page_title' => 'Create Education Levels',
        ];
        return view('admin.education_levels.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        EducationLevel::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Education Level has been added successfully', 'icon' => 'success']);
        return redirect()->route('education-levels.index');
    }
    public function show(EducationLevel $educationLevel)
    {
        //
    }
    public function edit(EducationLevel $educationLevel)
    {
        $data = [
            'page_name' => 'education-levels',
            'page_title' => 'Edit Education Level | Locations',
            'education_level' => $educationLevel,
        ];
        return view('admin.education_levels.edit', $data);
    }
    public function update(Request $request, EducationLevel $educationLevel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $educationLevel->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Education Level has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }
    public function destroy(EducationLevel $educationLevel)
    {
        $educationLevel->delete();
        session()->flash('alert_message', ['message' => 'The Education Level has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('education-levels.index');
    }
}
