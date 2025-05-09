<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{

    protected $fillable = [
        'job_id',
        'question',
    ];

    use HasFactory;
}
