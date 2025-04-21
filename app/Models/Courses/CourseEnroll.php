<?php

namespace App\Models\Courses;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnroll extends Model
{
    use HasFactory;
    protected $guarded = [];


    // course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // accepted by
    public function user()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }
}
