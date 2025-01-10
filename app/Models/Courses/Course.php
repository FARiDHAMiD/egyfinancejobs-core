<?php

namespace App\Models\Courses;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'type_id');
    }

    public function cat()
    {
        return $this->belongsTo(CourseCat::class, 'cat_id');
    }

    public function statu()
    {
        return $this->belongsTo(CourseStatu::class, 'statu_id');
    }

    // instructor
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
