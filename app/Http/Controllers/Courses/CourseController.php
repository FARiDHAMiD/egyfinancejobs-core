<?php

namespace App\Http\Controllers\Courses;


use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseCat;
use App\Models\Courses\CourseStatu;
use App\Models\Courses\CourseType;
use App\Models\Courses\InstructorProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {
        $courses = Course::all();
        $data = [
            'page_name' => 'Admin Courses',
            'page_title' => '',
            'courses' => $courses,
        ];
        return view('admin.courses.index', $data);
    }

    public function index()
    {
        $course_cats = CourseCat::all();
        $data = [
            'page_name' => 'Courses',
            'page_title' => 'Courses',
            'cats' => $course_cats,
        ];
        return view('courses.index', $data);
    }

    public function course_cat($cat, Request $request)
    {
        $course_cats = CourseCat::all();
        $courses = Course::where('cat_id', $cat)->get();
        $searchQuery = $request->input('search_field');
        $coursesQuery = Course::where('cat_id', $cat)->when($searchQuery != null, function ($query) use ($searchQuery) {
            return $query->where(function ($query) use ($searchQuery) {
                $query->where('name', 'LIKE', "%$searchQuery%");
            })->latest();
        })->get();
        $data = [
            'page_name' => $cat,
            'page_title' => 'Courses',
            'courses' => $coursesQuery,
            'cats' => $course_cats,
        ];
        return view('courses.allCourses', $data);
    }

    public function show_all(Request $request)
    {
        $course_cats = CourseCat::all();
        $searchQuery = $request->input('search_field');
        $coursesQuery = Course::when($searchQuery != null, function ($query) use ($searchQuery) {
            return $query->where(function ($query) use ($searchQuery) {
                $query->where('name', 'LIKE', "%$searchQuery%");
            })->latest();
        })->get();

        // dd($coursesQuery);
        $data = [
            'page_name' => 'All Courses',
            'page_title' => 'Courses',
            'courses' => $coursesQuery,
            'cats' => $course_cats,
        ];
        return view('courses.allCourses', $data);
    }

    public function instructors()
    {
        $instructors = User::whereRoleIs('instructor')->get();
        $data = [
            'page_name' => 'Instructors',
            'page_title' => 'Instructors',
            'instructors' => $instructors,
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

    public function profile()
    {
        $data = [
            'page_name' => 'Profile',
            'page_title' => 'Profile',
        ];
        return view('courses.profile', $data);
    }

    // show instructor profile
    public function instructorProfile($uuid = null)
    {
        $instructor = User::where('uuid', '=', $uuid)->firstOrFail();
        $instructor_profile = InstructorProfile::where('instructor_id', '=', $instructor->id)->firstOrFail();
        $instructor_courses = Course::where('instructor_id', $instructor->id)->get();
        if (!$instructor->email_verified_at) {
            session()->flash('alert_message', ['message' => 'Your Profile is being reviewed by Egy Finance Courses Team, Thank you for your understanding.!', 'icon' => 'warning']);
            return redirect()->back();
        }
        $data = [
            'page_name' => 'Profile',
            'page_title' => 'Profile',
            'instructor' => $instructor,
            'profile' => $instructor_profile,
            'instructor_courses' => $instructor_courses,
        ];
        return view('courses.instructorProfile', $data);
    }

    // edit instructor profile
    public function instructorProfileEdit($uuid = null)
    {
        $instructor = User::where('uuid', '=', $uuid)->firstOrFail();
        $instructor_profile = InstructorProfile::where('instructor_id', '=', $instructor->id)->firstOrFail();
        // dd($instructor, $instructor_profile);
        $data = [
            'page_name' => 'Edit Profile',
            'page_title' => 'Edit Profile',
            'instructor' => $instructor,
            'profile' => $instructor_profile,
        ];
        if (auth()->user()) {
            return view('courses.instructorProfileEdit', $data);
        } else {
            return back();
        }
    }

    // update instructor profile
    public function instructorProfileUpdate(Request $request, $id)
    {
        $instructor = auth()->user();
        $profile = InstructorProfile::where('instructor_id', $id)->firstOrFail();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'nullable|digits:11',
            'address' => 'nullable|max:150',
            'birthdate' => [
                'required',
                'date',
                'before:' . Carbon::now()->subYears(16),
                'after:' .  Carbon::now()->subYears(90),
            ],
            'bio' => 'nullable|max:500',
        ]);

        // change instructor profile image
        if ($request->has('profile_img')) {
            $file = $request->file('profile_img');
            $mime = $file->getMimeType();
            if (!in_array($mime, ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/svg+xml'])) {
                return back()->withErrors(['profile_img' => 'Invalid image format.']);
            }
            $request->validate(
                ['profile_img' => 'image|max:5000'],
                [
                    'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'profile_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );

            $instructor->clearMediaCollection('instructor_profile')
                ->addMediaFromRequest('profile_img')
                ->toMediaCollection('instructor_profile');
        }

        $instructor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $profile->update([
            'job_title' => $request->job_title,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'qualification' => $request->qualification,
            'birthdate' => $request->birthdate,
            'bio' => $request->bio,
        ]);

        session()->flash('alert_message', ['message' => 'Profile Updated Sucessfully!', 'icon' => 'success']);
        return redirect()->route('courses.instructorProfile', $instructor->uuid);
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
        $cats = CourseCat::all();
        $types = CourseType::all();
        $status = CourseStatu::all();
        $instructors = User::whereRoleIs('instructor')->get();
        $data = [
            'page_name' => 'Admin Courses',
            'page_title' => 'Create Course',
            'cats' => $cats,
            'types' => $types,
            'status' => $status,
            'instructors' => $instructors,
        ];
        return view('admin.courses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'string|max:255',
            'info' => 'string|max:500',
            'cat_id' => 'required',
            'type_id' => 'required',
            'statu_id' => 'required',
            'job_title' => 'max:255|string',
            'start_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(2),
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date'
            ],
            'hours' => 'nullable|numeric',
            'max_enroll' => 'nullable|numeric|max:100000',
            'price' => 'nullable|numeric',
        ]);

        $course =  Course::create([
            'name' => $request->name,
            'info' => $request->info,
            'cat_id' => $request->cat_id,
            'type_id' => $request->type_id,
            'statu_id' => $request->statu_id,
            'instructor_id' => $request->instructor_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'hours' => $request->hours,
            'max_enroll' => $request->max_enroll,
            'price' => $request->price,
            'place' => $request->place,
            'prerequisite' => $request->prerequisite,
            'video_url' => $request->video_url,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'featured' => $request->boolean(key: 'featured'),
            'user_id' => Auth::id(),
        ]);

        // change course thumbnail image

        if ($request->has('profile_img')) {
            $file = $request->file('profile_img');
            $mime = $file->getMimeType();
            if (!in_array($mime, ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/svg+xml'])) {
                return back()->withErrors(['profile_img' => 'Invalid image format.']);
            }
            $request->validate(
                ['profile_img' => 'image|max:5000'],
                [
                    'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'profile_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $course->clearMediaCollection('course_profile')
                ->addMediaFromRequest('profile_img')
                ->toMediaCollection('course_profile');
        }
        session()->flash('alert_message', ['message' => 'New Course has been created successfully', 'icon' => 'success']);
        return redirect()->route('admin.course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $course = Course::where('uuid', $uuid)->firstOrFail();
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
        $cats = CourseCat::all();
        $types = CourseType::all();
        $status = CourseStatu::all();
        $instructors = User::whereRoleIs('instructor')->get();
        $data = [
            'page_name' => 'Edit Course',
            'page_title' => 'Edit Course',
            'cats' => $cats,
            'types' => $types,
            'status' => $status,
            'instructors' => $instructors,
            'course' => $course,
        ];
        return view('admin.courses.edit', $data);
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

        $request->validate([
            'name' => 'string|max:255',
            'info' => 'string|max:500',
            'cat_id' => 'required',
            'type_id' => 'required',
            'statu_id' => 'required',
            'job_title' => 'max:255|string',
            'start_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(2),
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date'
            ],
            'hours' => 'nullable|numeric',
            'max_enroll' => 'nullable|numeric|max:100000',
            'price' => 'nullable|numeric',
        ]);

        $course->update([
            'name' => $request->name,
            'info' => $request->info,
            'cat_id' => $request->cat_id,
            'type_id' => $request->type_id,
            'statu_id' => $request->statu_id,
            'instructor_id' => $request->instructor_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'hours' => $request->hours,
            'max_enroll' => $request->max_enroll,
            'price' => $request->price,
            'place' => $request->place,
            'prerequisite' => $request->prerequisite,
            'video_url' => $request->video_url,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'featured' => $request->boolean(key: 'featured'),
            'user_id' => Auth::id(),
        ]);

        // change course thumbnail image

        if ($request->has('profile_img')) {
            $file = $request->file('profile_img');
            $mime = $file->getMimeType();
            if (!in_array($mime, ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/svg+xml'])) {
                return back()->withErrors(['profile_img' => 'Invalid image format.']);
            }
            $request->validate(
                ['profile_img' => 'image|max:5000'],
                [
                    'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'profile_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $course->clearMediaCollection('course_profile')
                ->addMediaFromRequest('profile_img')
                ->toMediaCollection('course_profile');
        }
        session()->flash('alert_message', ['message' => 'Course Updated Successfully', 'icon' => 'success']);
        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        Course::findOrFail($course->id)->delete();
        session()->flash('alert_message', ['message' => 'The course has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    // create instructor profile from guest
    function createInstructor()
    {
        $data = [
            'page_name' => 'Create Instructor',
            'page_title' => 'Create Instructor',
        ];
        if (auth()->check()) {
            return back();
        } else {
            return view('courses.createInstructor', $data);
        }
    }

    public function storeInstructor(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:8|confirmed',
        ]);

        $instructor =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // 'g-recaptcha-response' => 'recaptcha', // late for online use
        ]);

        $instructor->attachRole('instructor');

        session()->flash('alert_message', ['message' => 'Your request is being reviewd by our team, Thank You for joining Egy Finance Courses!', 'icon' => 'success']);
        return redirect()->back();
    }

    // create instructor profile from admin
}
