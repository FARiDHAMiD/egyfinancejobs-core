<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{

    protected $fillable = [
        'job_uuid',
        'employer_id',
        'job_title',
        'country_id',
        'city_id',
        'area_id',
        'category_id',
        'education_level_id',
        'type_id',
        'career_level_id',
        'years_experience',
        'salary',
        'job_description',
        'job_excerpt',
        'job_requirements',
        'external_url',
        'external_email',
    ];

    use HasFactory;

    public function type()
    {
        return $this->belongsTo(JobType::class, 'type_id');
    }
    public function category()
    {
        return $this->belongsTo(JobCategory::class,'category_id');
    }

    public function career_level()
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }
    public function employer_profile()
    {
        return $this->belongsTo(EmployerProfile::class, 'employer_id', 'employer_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    public function questions()
    {
        return $this->hasMany(JobQuestion::class);
    }

}
