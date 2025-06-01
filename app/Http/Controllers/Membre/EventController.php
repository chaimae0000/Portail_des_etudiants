<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventParticipation;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        $user = Auth::user();

// Récupérer son ID
$userId = Auth::id();
        $participatedEventIds = EventParticipation::where('user_id', $userId)->pluck('event_id')->toArray();

        return view('frontend.user.member.events.index', compact('events', 'participatedEventIds'));
    }

    public function participer($id)
{
    $userId = Auth::id();

    // Vérifier si l'utilisateur est déjà inscrit
    $already = EventParticipation::where('user_id', $userId)
        ->where('event_id', $id)
        ->exists();

    if ($already) {
        return back()->with('info', 'Vous participez déjà à cet événement.');
    }

    // Récupérer l'événement avec le nombre actuel de participations
    $event = Event::withCount('participations')->findOrFail($id);

    // Vérifier si le nombre maximum est atteint
    if ($event->max_participants !== null && $event->participations_count >= $event->max_participants) {
        return back()->with('info', 'Le nombre maximum de participants est atteint. Impossible de s\'inscrire.');
    }

    // Créer la participation
    EventParticipation::create([
        'user_id' => $userId,
        'event_id' => $id,
        'status' => 'registered',
    ]);

    return back()->with('success', 'Vous êtes inscrit à cet événement.');
}

    public function mesEvenements()
    {
        $user = Auth::user();

        // Soit avec la relation many-to-many :
        $events = $user->events;

        return view('frontend.user.member.events.mes_evenements', compact('events'));
    }
}
