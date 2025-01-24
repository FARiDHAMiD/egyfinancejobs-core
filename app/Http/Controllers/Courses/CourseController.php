<?php

namespace App\Http\Controllers\Courses;


use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use App\Models\Courses\Course;
use App\Models\Courses\CourseCat;
use App\Models\Courses\CourseEnroll;
use App\Models\Faq;
use App\Models\Courses\CourseStatu;
use App\Models\Courses\CourseType;
use App\Models\Courses\InstructorProfile;
use App\Models\Events\Event;
use App\Models\Events\EventRegister;
use App\Models\SocialLink;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $courses = Course::where('featured', 1)->get();
        $events = Event::where('statu_id', '!=', '3')->orderBy('start_date', 'asc')->get();
        $completed_events = Event::where('statu_id', '=', '3')->orderBy('start_date', 'asc')->get();
        $faqs = Faq::where('website', 1)->paginate(5);
        $data = [
            'page_name' => 'Courses',
            'page_title' => '',
            'cats' => $course_cats,
            'courses' => $courses,
            'events' => $events,
            'completed_events' => $completed_events,
            'faqs' => $faqs,
        ];
        return view('courses.index', $data);
    }

    function soon()
    {
        $data = [
            'page_name' => 'Coming Soon',
            'page_title' => 'Coming Soon',
        ];
        return view('courses.includes.soon', $data);
    }
    function privacy()
    {
        $data = [
            'page_name' => 'Coming Privacy',
            'page_title' => 'Coming Privacy',
        ];
        return view('courses.privacy', $data);
    }
    function terms()
    {
        $data = [
            'page_name' => 'Coming Terms',
            'page_title' => 'Coming Terms',
        ];
        return view('courses.terms', $data);
    }

    public function course_cat($cat, Request $request)
    {
        $course_cats = CourseCat::all();
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

    // enroll in course by user(employee)
    public function enroll($student_id, $course_id)
    {
        // dd($student_id, $course_id);
        $student = User::findOrFail($student_id);
        if (!$student->hasRole('employee')) {
            session()->flash('alert_message', ['message' => 'Please create student profile to enroll in this course', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            // student_id and course_id unique together 

            $data = [
                'student_id' => $student_id,
                'course_id' => $course_id,
            ];

            $rule =  [
                'student_id' => [
                    Rule::unique('course_enrolls', 'student_id')
                        ->where('course_id', $course_id)
                ]
            ];
            $message = [
                'student_id.unique' => 'Cannot Enroll in the same course with the same status and instructor more than once',
            ];
            $validator = Validator::make($data, $rule, $message);
            if ($validator->fails()) {
                session()->flash('alert_message', ['message' => 'Cannot Enroll in the same course with the same status and instructor more than once', 'icon' => 'danger']);
                return redirect()->back();
            } else {
                CourseEnroll::create([
                    'student_id' => $student_id,
                    'course_id' => $course_id,
                    'created_at' => Carbon::now(),
                ]);
                session()->flash('alert_message', ['message' => 'Enrolled Successfully, Thank You!', 'icon' => 'success']);
                return redirect()->back();
            }
        }
    }

    // delete enroll in course by user(employee)
    public function cancel_enroll($id)
    {
        $enroll = CourseEnroll::findOrFail($id);
        $enroll->delete();
        session()->flash('alert_message', ['message' => 'Course Enrollment Canceled Successfully!, Thank You!', 'icon' => 'success']);
        return redirect()->back();
    }

    // review courses enrolls by admin
    public function courses_enroll_review()
    {
        $enrolls = CourseEnroll::all();
        $data = [
            'page_name' => 'Courses Enrolls',
            'page_title' => 'Courses Enrolls',
            'enrolls' => $enrolls,
        ];
        return view('admin.courses.enrolls', $data);
    }

    function accept_enroll($id)
    {
        $enroll = CourseEnroll::findOrFail($id);
        $enroll->update([
            'enroll_statu' => 1,
            'accepted_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);
        session()->flash('alert_message', ['message' => 'Student has been approved in this course successfully', 'icon' => 'success']);
        return redirect()->back();
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

    public function profile($uuid)
    {
        $student = User::whereRoleIs('employee')->where('uuid', $uuid)->firstOrFail();
        $student_enrolls = CourseEnroll::where('student_id', $student->id)->get();
        // dd($student_enrolls);
        $data = [
            'page_name' => 'Courses Profile',
            'page_title' => 'Courses Profile',
            'student' => $student,
            'enrolls' => $student_enrolls,
        ];
        // only admins and instructors can review student profile
        if (Auth::check() && Auth::user()->whereRoleIs('instuctor') || Auth::check() && Auth::user()->whereRoleIs('admin')) {
            return view('courses.profile', $data);
        } else {
            return back();
        }
    }

    // show instructor profile
    public function instructorProfile($uuid = null)
    {
        $instructor = User::where('uuid', '=', $uuid)->firstOrFail();
        $instructor_profile = InstructorProfile::where('instructor_id', '=', $instructor->id)->firstOrFail();
        $instructor_courses = Course::where('instructor_id', $instructor->id)->get();
        $instructor_events = Event::where('instructor_id', $instructor->id)->get();
        if (!$instructor->email_verified_at) {
            session()->flash('alert_message', ['message' => 'Your Profile is being reviewed by Egy Finance Courses Team, Thank you for your understanding.!', 'icon' => 'warning']);
            return redirect()->back();
        }
        $data = [
            'page_name' => 'Profile',
            'page_title' => $instructor->first_name . ' ' . $instructor->last_name,
            'instructor' => $instructor,
            'profile' => $instructor_profile,
            'instructor_courses' => $instructor_courses,
            'instructor_events' => $instructor_events,
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
            'facebook' => 'nullable|string|max:250',
            'linkedin' => 'nullable|string|max:250',
            'youtube' => 'nullable|string|max:250',
            'website' => 'nullable|string|max:250',
        ]);


        if ($instructor->user_social_links != null) {
            SocialLink::where('user_id', $instructor->id)->update([
                'linkedin' => $request->linkedin,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'website' => $request->website,
            ]);
        } else {
            SocialLink::create([
                'user_id' => $instructor->id,
                'linkedin' => $request->linkedIn,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'website' => $request->website,
            ]);
        }




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
        $events = Event::where('statu_id', '!=', '3')->orderBy('start_date', 'asc')->get();
        $completed_events = Event::where('statu_id', '=', '3')->orderBy('start_date', 'asc')->get();
        $data = [
            'page_name' => 'Events',
            'page_title' => 'Events',
            'events' => $events,
            'completed_events' => $completed_events,
        ];
        return view('courses.eventsCourse', $data);
    }

    function show_event($uuid)
    {
        $event = Event::where('uuid', $uuid)->first();
        $registers = EventRegister::where('event_id', $event->id)->get();
        // check if current login student is registered in the event
        $user_registered = $registers->where('user_id', Auth::id())->first();
        $data = [
            'page_name' => 'Events',
            'page_title' => 'Events',
            'event' => $event,
            'user_registered' => $user_registered,
        ];
        return view('courses.singleEvent', $data);
    }

    // resgister in events by users (employees / instructors)
    public function event_register($user_id, $event_id)
    {


        // user_id and event_id unique together 
        $data = [
            'user_id' => $user_id,
            'event_id' => $event_id,
        ];

        $rule =  [
            'user_id' => [
                Rule::unique('event_registers', 'user_id')
                    ->where('event_id', $event_id)
            ]
        ];
        $message = [
            'user_id.unique' => 'Cannot Register in the same event twice!',
        ];
        $validator = Validator::make($data, $rule, $message);
        if ($validator->fails()) {
            session()->flash('alert_message', ['message' => 'Cannot Register in the same event twice!', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            EventRegister::create([
                'user_id' => $user_id,
                'event_id' => $event_id,
                'created_at' => Carbon::now(),
            ]);
            session()->flash('alert_message', ['message' => 'Registered Successfully, Thank You!', 'icon' => 'success']);
            return redirect()->back();
        }
    }

    // delete event_register in course by user(employee)
    public function cancel_event_register($id)
    {
        $event_register = EventRegister::findOrFail($id);
        $event_register->delete();
        session()->flash('alert_message', ['message' => 'Event Registeration Canceled Successfully!, Thank You!', 'icon' => 'success']);
        return redirect()->back();
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

        $data = [
            'name' => $request->name,
            'instructor_id' => $request->instructor_id,
            'statu_id' => $request->statu_id,
        ];

        $rule =  [
            'name' => [
                Rule::unique('courses', 'name')
                    ->where('instructor_id', $request->instructor_id)->where('statu_id', $request->statu_id)
            ]
        ];
        $message = [
            'name.unique' => 'Course with same name, instructor and status already registered!',
        ];
        $validator = Validator::make($data, $rule, $message);
        if ($validator->fails()) {
            session()->flash('alert_message', ['message' => 'Course with same name, instructor and status already registered!', 'icon' => 'danger']);
            return redirect()->back()->withInput();
        }

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
            'hide_price' => $request->boolean(key: 'hide_price'),
            'user_id' => Auth::id(),
        ]);

        // change course thumbnail image


        if ($request->has('course_img')) {
            $request->validate(
                ['course_img' => 'image|max:5000'],
                [
                    'course_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'course_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $course->clearMediaCollection('course_img');
            $course->addMediaFromRequest('course_img')
                ->toMediaCollection('course_img');
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
        $enrolls = CourseEnroll::where('course_id', $course->id)->get();
        // check if current login student is enrolled in the course
        $student_enrolled = $enrolls->where('student_id', Auth::id())->first();
        $data = [
            'page_name' => 'Show Course',
            'page_title' => $course->name,
            'course' => $course,
            'enrolls' => $enrolls,
            'student_enrolled' => $student_enrolled,
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
            'start_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(2),
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'hours' => 'nullable|numeric',
            'max_enroll' => 'nullable|numeric|min:1|max:100000',
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
            'hide_price' => $request->boolean(key: 'hide_price'),
            'user_id' => Auth::id(),
        ]);

        // change course thumbnail image

        if ($request->has('course_img')) {
            $request->validate(
                ['course_img' => 'image|max:5000'],
                [
                    'course_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'course_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $course->clearMediaCollection('course_img');
            $course->addMediaFromRequest('course_img')
                ->toMediaCollection('course_img');
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
        if (auth()->check() && !auth()->user()->hasRole('employee')) {
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

    // reviews

    public function review_store(Request $request, $course_id)
    {
        // Validate input
        $request->validate([
            'review_txt' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Get authenticated student
        $student = Auth::user();  // Assuming the user is a student

        // Check if student already reviewed this course
        if (CourseReview::where('student_id', $student->id)->where('course_id', $course_id)->exists()) {
            session()->flash('alert_message', ['message' => 'You have already reviewed this course!', 'icon' => 'danger']);
            return redirect()->back();
        }

        // Create the review
        CourseReview::create([
            'student_id' => $student->id,
            'course_id' => $course_id,
            'review_txt' => $request->review_txt,
            'rating' => $request->rating,
        ]);
        session()->flash('alert_message', ['message' => 'Review submitted successfully!', 'icon' => 'success']);
        return redirect()->back();
    }

    public function faqs()
    {
        $faqs = Faq::where('website', 1)->get();
        $data = [
            'page_name' => 'FAQs',
            'page_title' => 'FAQs',
            'faqs' => $faqs,
        ];
        return view('courses.faqsCourse', $data);
    }
}
