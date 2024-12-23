<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'career_level_id');
    }
}
