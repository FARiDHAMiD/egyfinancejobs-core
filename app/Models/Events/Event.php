<?php

namespace App\Models\Events;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded = [];


    public function type()
    {
        return $this->belongsTo(EventType::class, 'type_id');
    }

    public function statu()
    {
        return $this->belongsTo(EventStatu::class, 'statu_id');
    }

    // created by
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
