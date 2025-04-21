<?php

namespace App\Models;

use App\Models\Courses\Course;
use App\Models\Courses\CourseEnroll;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'remember_token',
        'email_verified_at',
        'cv',
        'google_id',
        'featured',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function employee_profile()
    {
        return $this->hasOne("App\Models\EmployeeProfile", 'employee_id', 'id');
    }

    public function employer_profile()
    {
        return $this->hasOne("App\Models\EmployerProfile", 'employer_id', 'id');
    }

    public function instructor_profile()
    {
        return $this->hasOne("App\Models\Courses\InstructorProfile", 'instructor_id', 'id');
    }

    public function employee_experiences()
    {
        return $this->hasMany(Experience::class, 'employee_id')->orderBy('currently_work_there', 'DESC')->orderBy('ending_in', 'DESC')->latest();
    }

    public function employee_educations()
    {
        return $this->hasMany(Education::class, 'employee_id')->orderBy('degree_date', 'DESC')->latest();
    }
    public function employee_skills2($category = null)
    {
        return $this->hasMany(EmployeeSkill::class, 'employee_id');
    }
    public function employee_skills($category = null)
    {
        if (empty($category)) {
            return $this->hasMany(EmployeeSkill::class, 'employee_id')
                ->join('skills', 'employee_skills.skill_id', '=', 'skills.id')
                ->get('employee_skills.*');
        } else {
            return $this->hasMany(EmployeeSkill::class, 'employee_id')
                ->join('skills', 'employee_skills.skill_id', '=', 'skills.id')
                ->where('skills.category', $category)
                ->get('employee_skills.*');
        }
    }
    public function user_social_links()
    {
        return $this->hasOne(SocialLink::class)->latest();
    }

    public function image_certificate()
    {
        return $this->hasMany(CertificateImage::class, 'user_id');
    }

    public function job_types()
    {
        return $this->belongsToMany(JobType::class, 'employee_job_type', 'employee_id');
    }
    public function saved_jobs()
    {
        return $this->belongsToMany(Job::class, 'saved_jobs', 'employee_id');
    }

    public function applied_jobs()
    {
        return $this->belongsToMany(Job::class, 'job_applications', 'employee_id');
    }

    public function courses()
    {
        return $this->hasMany(CourseEnroll::class, 'student_id');
    }

    public function job_applications()
    {
        return $this->hasMany(JobApplication::class, 'employee_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'employee_id');
    }

    public function job_categories()
    {
        return $this->belongsToMany(JobCategory::class, 'employee_job_category', 'employee_id');
    }
    public function employee_achievements()
    {
        return $this->hasOne(EmployeeAchievement::class, 'employee_id', 'id');
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb-cropped')
            ->crop('crop-center', 150, 150);

        $this->addMediaConversion('banner-cropped')
            ->crop('crop-center', 2400, 252);
    }


    public function employer_jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    // courses reviews
    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    // instructor courses
    public function instructor_courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
}
