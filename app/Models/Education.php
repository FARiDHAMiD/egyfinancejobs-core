<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Education extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'employee_id',
        'education_level_id',
        'degree_details',
        'university_id',
        'degree_date',
        'certificate_title',
        'grade',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class);
    }

}
