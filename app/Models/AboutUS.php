<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUS extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook',
        'telegram',
        'linkedin',
        'about_company',
        'phone',
    ];
}
