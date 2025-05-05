<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;

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
        return view('Frontend.user.admin.events.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Récupération des données envoyées
        $data = $request->all();
    
        // Traitement de l'image si elle est présente
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $data['image'] = $imagePath;
        }
    
        try {
            // Tentative d'insertion des données dans la base de données
            Event::create($data);
    
            // Si tout se passe bien, rediriger avec un message de succès
            return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur avec l'exception
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
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
