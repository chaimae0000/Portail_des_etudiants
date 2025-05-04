<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('Frontend.user.admin.events.index', compact('events'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Frontend.user.admin.events.create');
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
            'time' => 'required|date_format:H:i',
        ]);
    
        Event::create($request->all());
    
        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
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
