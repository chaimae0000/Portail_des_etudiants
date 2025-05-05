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
        Log::info('Requête reçue dans store()', [
            'all' => $request->all(),
            'files' => $request->hasFile('image') ? 'Oui' : 'Non'
        ]);
    
        try {
            // Validation des données
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'date' => 'required|date',
                'time' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
            Log::info('Validation passée', $validated);
            
            // Traitement de l'image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
                $validated['image'] = $imagePath;
                Log::info('Image traitée', ['path' => $imagePath]);
            }
            
            // Création de l'événement
            Log::info('Tentative de création avec les données', $validated);
            $event = Event::create($validated);
            Log::info('Événement créé', ['id' => $event->id]);
            
            return response()->json([
                'success' => true,
                'event' => $event,
                'message' => 'Événement créé avec succès.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erreur de validation', [
                'errors' => $e->errors(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Exception dans store()', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
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
