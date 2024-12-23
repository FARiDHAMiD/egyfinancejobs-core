<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'career_level_id',
        'open_job_type_ids',
        'job_title_id',
        'job_category_ids',
        'accepted_salary',
        'show_salary',
        'searchable',
        'profile_public',
        'birthdate',
        'gender',
        'country_id',
        'city_id',
        'area_id',
        'phone',
        'marital_status',
        'military_status',
    ];

    public function job_title()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }
    
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function career_level()
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id');
    }
}
