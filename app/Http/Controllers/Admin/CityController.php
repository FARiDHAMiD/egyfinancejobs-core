<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        $rows = City::latest();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Cities | Locations',
            'search' => $search,
            'cities' => $rows->get(),
        ];
        return view('admin.cities.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Create City | Locations',
            'countries' => Country::all(),
        ];
        return view('admin.cities.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
        City::create(['name' => $request->name, 'country_id' => $request->country_id]);
        session()->flash('alert_message', ['message' => 'The city has been added successfully', 'icon' => 'success']);
        return redirect()->route('cities.index');
    }

    public function show(City $city)
    {
        //
    }

    public function edit(City $city)
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Edit City | Locations',
            'countries' => Country::all(),
            'city' => $city,
        ];
        return view('admin.cities.edit', $data);
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
        $city->update(['name' => $request->name, 'country_id' => $request->country_id]);
        session()->flash('alert_message', ['message' => 'The city has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(City $city)
    {
        $city->delete();
        session()->flash('alert_message', ['message' => 'The city has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('cities.index');
    }
}
