<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAchievement extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'description',
    ];
    
}
