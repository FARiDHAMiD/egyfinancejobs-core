<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{

    protected $fillable = [
        'employer_id',
        'title',
        'mobile_number',
        'company_name',
        'company_description',
        'company_industry_id',
        'company_size',
        'country_id',
        'city_id',
        'area_id',
        'featured', //default 0
        'bio',
    ];

    use HasFactory;
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'company_industry_id');
    }
}
