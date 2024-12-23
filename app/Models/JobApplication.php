<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'job_id',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function application_answers()
    {
        return $this->hasMany(JobApplicationAnswer::class, 'job_application_id');
    }
}
