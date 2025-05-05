<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::paginate(5); // Pagination classique
    
        // Vérification si la requête est une requête AJAX
        if ($request->ajax()) {
            // Retourner les événements en JSON avec la structure appropriée
            return response()->json([
                'events' => $events->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->title,
                        'description' => Str::limit($event->description, 100),
                        'date' => $event->date,
                        'time' => $event->time,
                        'image' => $event->image ? asset('storage/' . $event->image) : null,
                    ];
                }),
                'next_page' => $events->hasMorePages() ? $events->nextPageUrl() : null // Ajouter le lien pour la page suivante
            ]);
        }
    
        // Si ce n'est pas une requête AJAX, retourner la vue avec les événements
        return view('Frontend.user.admin.events.list', compact('events'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Frontend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // Valider les champs du formulaire
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Préparer les données à enregistrer
    $data = $request->only(['title', 'description', 'date', 'time']);

    // Gérer l'upload de l'image si présente
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events', 'public');
    }

    // Créer l'événement
    Event::create($data);

    // Rediriger avec message de succès
    return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès.');
}

    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Frontend.user.admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Frontend.user.admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
    
        $event = Event::findOrFail($id);
        $event->update($request->all());
    
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    
    }
}
