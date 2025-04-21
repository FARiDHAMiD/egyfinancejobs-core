<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function type()
    {
        return $this->belongsTo(JobType::class, 'type_id');
    }
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    public function career_level()
    {
        return $this->belongsTo(CareerLevel::class, 'career_level_id');
    }

    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
