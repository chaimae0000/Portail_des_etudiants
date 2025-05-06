<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Récupère tous les événements, sans pagination
        $events = Event::all(); 
        
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
                'next_page' => null // Pas de pagination ici
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
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'time' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('events', 'public');
    }

    $event = Event::create([
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
        'time' => $request->time,
        'image' => $imagePath,
    ]);

    // 🧠 Si AJAX → JSON
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Événement créé avec succès',
            'event' => $event
        ]);
    }

    // ✅ Sinon → redirection classique
    return redirect()->route('events.list')->with('success', 'Événement créé avec succès');
}

   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('Frontend.user.admin.events.show', compact('event'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id); // Trouver l'événement par son ID
        return view('events.edit', compact('event')); // Retourner la vue avec les données de l'événement
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            // Trouver l'événement à mettre à jour
            $event = Event::findOrFail($id);
            
            // Préparer les données à mettre à jour
            $updateData = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
            ];
            
            // Traiter l'image si elle est fournie
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($event->image && file_exists(public_path('storage/' . $event->image))) {
                    unlink(public_path('storage/' . $event->image));
                }
                
                // Stocker la nouvelle image
                $imagePath = $request->file('image')->store('events', 'public');
                $updateData['image'] = $imagePath;
            }
            
            // Débogage avant la mise à jour
            Log::info('Données à mettre à jour pour l\'événement ' . $id . ':', $updateData);
            
            // Mettre à jour l'événement
            $updated = $event->update($updateData);
            
            // Débogage après la mise à jour
            Log::info('Résultat de la mise à jour: ' . ($updated ? 'Succès' : 'Échec'));
            
            if (!$updated) {
                return back()->withInput()->with('error', 'Échec de la mise à jour de l\'événement. Veuillez réessayer.');
            }
            
            // Rediriger avec un message de succès
            return redirect()->route('admin.events.show', $event->id)->with('success', 'L\'événement a été mis à jour avec succès.');
        } catch (\Exception $e) {
            // Log l'erreur
            Log::error('Erreur lors de la mise à jour de l\'événement: ' . $e->getMessage());
            
            // Rediriger avec un message d'erreur
            return back()->withInput()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
               // Trouver l'événement par son ID
               $event = Event::findOrFail($id);

               // Supprimer l'événement de la base de données
               $event->delete();
       
               // Retourner à la page des événements avec un message de succès
               return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès.');
    }
    
}
