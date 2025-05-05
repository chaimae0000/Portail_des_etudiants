@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>📅 Liste des Événements</h2>

    <!-- Bouton pour ouvrir le modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal">Créer un Événement</button>

    <!-- Liste des événements -->
    <div id="event-container">
        @foreach($events as $event)
            <div class="card mb-3 event-card" data-id="{{ $event->id }}">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="Image de l’événement">
                @endif
                <div class="card-body">
                    <h5>{{ $event->title }}</h5>
                    <p>{{ Str::limit($event->description, 100) }}</p>
                    <p class="text-muted">{{ $event->date }} à {{ $event->time }}</p>
                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-primary">🔍 Détails</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal de création d'événement -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Créer un Nouvel Événement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Créer l'Événement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
