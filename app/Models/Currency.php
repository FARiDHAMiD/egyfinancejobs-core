<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'unicode',
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class, 'currency_id', 'id');
    }
}
