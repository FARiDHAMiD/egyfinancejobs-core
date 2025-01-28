<?php

namespace App\Models\Courses;

use App\Models\CourseReview;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Course extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
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

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    // created by
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // courses reviews
    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }
}
