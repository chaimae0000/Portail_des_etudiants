@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>📅 Liste des Événements</h2>

    <!-- Button to trigger the modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal">Créer un Événement</button>

    <!-- Event List -->
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

    <div id="loading" class="text-center" style="display: none;">
        <span>Chargement...</span>
    </div>
</div>

<!-- Modal for creating an event -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Créer un Nouvel Événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                    @csrf
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
                    <button type="submit" class="btn btn-primary">Créer l'Événement</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
createEventForm.addEventListener('submit', function(event) {
    event.preventDefault();
    console.log('Formulaire soumis');
    
    const formData = new FormData(createEventForm);
    // Afficher les données du formulaire
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }
    
    console.log('Envoi de la requête AJAX...');
    fetch('{{ route("admin.events.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(response => {
        console.log('Réponse reçue', response);
        console.log('Statut:', response.status);
        return response.json().catch(error => {
            console.error('Erreur parsing JSON:', error);
            throw new Error('Réponse non-JSON');
        });
    })
    .then(data => {
        console.log('Données reçues:', data);
        // reste du code...
    })
    .catch(error => {
        console.error('Erreur complète:', error);
        alert('Une erreur est survenue: ' + error.message);
    });
});
var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();
</script>
@endsection
