<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;

class IndustryController extends Controller
{

    public function index()
    {
        $rows = Industry::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'industries',
            'page_title' => 'Industries',
            'search' => $search,
            'industries' => $rows->get(),
        ];
        return view('admin.industries.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'industries',
            'page_title' => 'Create Industries',
        ];
        return view('admin.industries.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Industry::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Industry has been added successfully', 'icon' => 'success']);
        return redirect()->route('industries.index');
    }

    public function show(Industry $industry)
    {
        //
    }

    public function edit(Industry $industry)
    {
        $data = [
            'page_name' => 'industries',
            'page_title' => 'Edit Industry | Locations',
            'industry' => $industry,
        ];
        return view('admin.industries.edit', $data);
    }


    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $industry->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The Industry has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        session()->flash('alert_message', ['message' => 'The Industry has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('industries.index');
    }
}
