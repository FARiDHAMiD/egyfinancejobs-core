<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
    public function index()
    {
        $rows = University::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'universities',
            'page_title' => 'Universities',
            'universities' => $rows->get(),
        ];
        return view('admin.universities.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'universities',
            'page_title' => 'Create Universities',
        ];
        return view('admin.universities.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        University::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The University has been added successfully', 'icon' => 'success']);
        return redirect()->route('universities.index');
    }

    public function show(University $university)
    {
        //
    }

    public function edit(University $university)
    {
        $data = [
            'page_name' => 'universities',
            'page_title' => 'Edit University | Locations',
            'university' => $university,
        ];
        return view('admin.universities.edit', $data);
    }

    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $university->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The University has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(University $university)
    {
        $university->delete();
        session()->flash('alert_message', ['message' => 'The University has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('universities.index');
    }
}
