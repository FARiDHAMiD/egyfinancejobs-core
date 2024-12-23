<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'country_id',
        'city_id',
        'name',
    ];
    use HasFactory;

    public function jobs()
    {
        return $this->hasMany(Job::class, 'area_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
