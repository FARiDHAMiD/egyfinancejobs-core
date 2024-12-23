<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'skill_id',
        'skill_level',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
