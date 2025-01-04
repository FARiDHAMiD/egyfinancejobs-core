<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $rows = Currency::query();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name;
            $search['name'] = $searchTerms;
            $rows->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'currencies',
            'page_title' => 'Currencies',
            'search' => $search,
            'currencies' => $rows->get(),
        ];
        return view('admin.currencies.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'currencies',
            'page_title' => 'Create Currencies',
        ];
        return view('admin.currencies.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'string|max:255',
        ]);
        Currency::create(['name' => $request->name, 'category' => $request->category]);
        session()->flash('alert_message', ['message' => 'The Currency has been added successfully', 'icon' => 'success']);
        return redirect()->route('currencies.index');
    }

    public function show(Currency $currency)
    {
        //
    }

    public function edit(Currency $currency)
    {
        $data = [
            'page_name' => 'currencies',
            'page_title' => 'Edit Currency | Locations',
            'currency' => $currency,
        ];
        return view('admin.currencies.edit', $data);
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);
        $currency->update(['name' => $request->name, 'category' => $request->category]);
        session()->flash('alert_message', ['message' => 'The Currency has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        session()->flash('alert_message', ['message' => 'The Currency has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('currencies.index');
    }
}
