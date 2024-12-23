<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'job_title',
        'company_name',
        'job_category_id',
        'company_industry_id',
        'job_type_id',
        'currently_work_there',
        'starting_from',
        'ending_in',
    ];
    public function job_type()
    {
        return $this->belongsTo(JobType::class);
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'company_industry_id');
    }
}
