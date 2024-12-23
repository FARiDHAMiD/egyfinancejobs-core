<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;


class CountryController extends Controller
{

    public function index()
    {
        $rows = Country::latest();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name ;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Countries | Locations',
            'search' => $search,
            'countries' => $rows->get(),
        ];
        return view('admin.countries.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Create Country | Locations',
        ];
        return view('admin.countries.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Country::create(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The country has been added successfully', 'icon' => 'success']);
        return redirect()->route('countries.index');
    }

    public function show(Country $country)
    {
        //
    }


    public function edit(Country $country)
    {
        $data = [
            'page_name' => 'locations',
            'page_title' => 'Edit Country | Locations',
            'country' => $country,
        ];
        return view('admin.countries.edit', $data);
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $country->update(['name' => $request->name]);
        session()->flash('alert_message', ['message' => 'The country has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Country $country)
    {
        $country->delete();
        session()->flash('alert_message', ['message' => 'The country has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('countries.index');
    }
}
