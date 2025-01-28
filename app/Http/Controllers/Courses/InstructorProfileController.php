<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses\InstructorProfile;
use App\Mail\InstructorApprovedEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class InstructorProfileController extends Controller
{

    public function index()
    {
        $instructors = User::whereRoleIs('instructor')->latest();
        // dd($instructors);
        $data = [
            'page_name' => 'instructors',
            'page_title' => 'Instructors',
            'instructors' => $instructors->get(),
        ];
        return view('admin.instructors.index', $data);
    }

    // by admin
    function verify_instructor($instructor_id)
    {
        $instructor_user = User::find($instructor_id);

        $instructor_user->update([
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        $instructor = InstructorProfile::where('instructor_id', $instructor_id)->first();

        InstructorProfile::create([
            'instructor_id' => $instructor_id,
            'active' => 1,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        Mail::to($instructor_user->email)->send(new InstructorApprovedEmail($instructor_user));
        session()->flash('alert_message', ['message' => 'Instructor Approved Successfully!', 'icon' => 'success']);
        return redirect()->back();
    }

    // by admin
    function delete_instructor($instructor_id)
    {
        $user = User::find($instructor_id);
        $instructor = InstructorProfile::where('instructor_id', $instructor_id)->first();
        $user->delete();
        $instructor->delete();
        session()->flash('alert_message', ['message' => 'Instructor Deleted Successfully!', 'icon' => 'success']);
        return redirect()->back();
    }
}
