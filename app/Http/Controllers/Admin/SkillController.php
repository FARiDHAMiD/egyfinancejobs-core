<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $rows = Skill::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'skills',
            'page_title' => 'Skills',
            'search' => $search,
            'skills' => $rows->get(),
        ];
        return view('admin.skills.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'skills',
            'page_title' => 'Create Skills',
        ];
        return view('admin.skills.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);
        Skill::create(['name' => $request->name , 'category' => $request->category]);
        session()->flash('alert_message', ['message' => 'The Skill has been added successfully', 'icon' => 'success']);
        return redirect()->route('skills.index');
    }

    public function show(Skill $skill)
    {
        //
    }

    public function edit(Skill $skill)
    {
        $data = [
            'page_name' => 'skills',
            'page_title' => 'Edit Skill | Locations',
            'skill' => $skill,
        ];
        return view('admin.skills.edit', $data);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);
        $skill->update(['name' => $request->name , 'category' => $request->category]);
        session()->flash('alert_message', ['message' => 'The Skill has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        session()->flash('alert_message', ['message' => 'The Skill has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('skills.index');
    }
}
