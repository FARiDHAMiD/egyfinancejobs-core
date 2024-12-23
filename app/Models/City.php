<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'name',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'city_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
