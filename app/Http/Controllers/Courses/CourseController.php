<?php

namespace App\Http\Controllers\Courses;


use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'page_name' => 'Courses',
        ];
        return view('courses.index', $data);
    }

    public function show_all()
    {
        $data = [
            'page_name' => 'All Courses',
            'page_title' => 'All Courses',
        ];
        return view('courses.allCourses', $data);
    }

    public function instructors()
    {
        $data = [
            'page_name' => 'Instructors',
            'page_title' => 'Instructors',
        ];
        return view('courses.instructors', $data);
    }

    public function about_us()
    {
        $data = [
            'page_name' => 'About Us',
            'page_title' => 'About Us',
        ];
        return view('courses.aboutCourse', $data);
    }

    public function faqs()
    {
        $data = [
            'page_name' => 'FAQs',
            'page_title' => 'FAQs',
        ];
        return view('courses.faqsCourse', $data);
    }

    public function events()
    {
        $data = [
            'page_name' => 'Events',
            'page_title' => 'Events',
        ];
        return view('courses.eventsCourse', $data);
    }

    public function contact_us()
    {
        $data = [
            'page_name' => 'Contact Us',
            'page_title' => 'Contact Us',
        ];
        return view('courses.contactCourse', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $data = [
            'page_name' => 'Show Course',
            'page_title' => $course->name,
            'course' => $course,
        ];
        return view('courses.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
