<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\CourseCat;


class CoursesCatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = CourseCat::all();
        // dd($cats);

        $data = [
            'page_name' => 'CATs',
            'page_title' => 'CATs',
            'cats' => $cats,
        ];
        return view('admin.courses_cats.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            'page_name' => 'CATs',
            'page_title' => 'Create CAT',
        ];
        return view('admin.courses_cats.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'Unique:course_cats|required|string',
        ]);
        CourseCat::create(
            [
                'name' => $request->name,
            ]
        );
        session()->flash('alert_message', ['message' => 'New Course Category has been added successfully', 'icon' => 'success']);
        return redirect()->route('cats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseCat $cat)
    {
        $data = [
            'page_name' => 'CATs',
            'page_title' => 'Edit CATs question',
            'cat' => $cat,
        ];
        return view('admin.courses_cats.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseCat $cat)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $cat->update([
            'name' => $request->name,
        ]);
        session()->flash('alert_message', ['message' => 'The Course Category has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseCat $cat)
    {
        $cat->delete();
        session()->flash('alert_message', ['message' => 'The Course Category has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('cats.index');
    }
}
