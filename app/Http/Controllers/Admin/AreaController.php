<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\City;
use App\Models\Area;

class AreaController extends Controller
{

    public function index()
    {
        $rows = Area::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Areas | Locations',
            'search' => $search,
            'areas' => $rows->get(),
        ];
        return view('admin.areas.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Create Area | Locations',
            'countries' => Country::all(),
            'cities' => City::all(),
        ];
        return view('admin.areas.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
        Area::create(['name' => $request->name, 'country_id' => $request->country_id , 'city_id' => $request->city_id]);
        session()->flash('alert_message', ['message' => 'The area has been added successfully', 'icon' => 'success']);
        return redirect()->route('areas.index');
    }

    public function show(Area $area)
    {
        //
    }

    public function edit(Area $area)
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Edit Area | Locations',
            'countries' => Country::all(),
            'cities' => City::all(),
            'area' => $area,
        ];
        return view('admin.areas.edit', $data);
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'country_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
        $area->update(['name' => $request->name, 'country_id' => $request->country_id , 'city_id' => $request->city_id]);
        session()->flash('alert_message', ['message' => 'The area has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Area $area)
    {
        $area->delete();
        session()->flash('alert_message', ['message' => 'The area has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('areas.index');
    }
}
