<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'status', // Par exemple: 'registered', 'confirmed', 'attended', 'cancelled'
    ];

    /**
     * Obtenir l'utilisateur qui participe à l'événement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir l'événement auquel l'utilisateur participe.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}