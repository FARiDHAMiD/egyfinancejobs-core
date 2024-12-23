<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerLevel;

class CareerLevelController extends Controller
{
    public function index()
    {
        $rows = CareerLevel::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'career-levels',
            'page_title' => 'Career Levels',
            'search' => $search,
            'career_levels' => $rows->get(),
        ];
        return view('admin.career_levels.index', $data);
    }
    public function create()
    {
        $data = [
            'page_name' => 'career-levels',
            'page_title' => 'Create Career Levels',
        ];
        return view('admin.career_levels.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        CareerLevel::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Career Level has been added successfully', 'icon' => 'success']);
        return redirect()->route('career-levels.index');
    }

    public function show(CareerLevel $careerLevel)
    {
        //
    }

    public function edit(CareerLevel $careerLevel)
    {
        $data = [
            'page_name' => 'career-levels',
            'page_title' => 'Edit Career Level | Locations',
            'career_level' => $careerLevel,
        ];
        return view('admin.career_levels.edit', $data);
    }

    public function update(Request $request, CareerLevel $careerLevel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $careerLevel->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Career Level has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(CareerLevel $careerLevel)
    {
        $careerLevel->delete();
        session()->flash('alert_message', ['message' => 'The Career Level has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('career-levels.index');
    }
}
