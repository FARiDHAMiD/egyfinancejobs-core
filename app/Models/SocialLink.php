<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'user_id',
        'linkedin',
        'facebook',
        'youtube',
        'website',
        'other',
    ];
}