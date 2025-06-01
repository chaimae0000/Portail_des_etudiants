<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'image',
        'max_participants',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];

    public function participations()
    {
        return $this->hasMany(EventParticipation::class);
    }

    public function participants()
{
    return $this->belongsToMany(User::class, 'event_participations', 'event_id', 'user_id')
                ->withTimestamps();
}

}
