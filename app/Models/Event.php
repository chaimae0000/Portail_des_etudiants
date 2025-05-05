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
        'image'
    ];
    
    // Si vous avez des conversions de types, assurez-vous qu'elles sont correctes
    protected $casts = [
        'date' => 'date',
    ];
}
