@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-calendar-event-fill me-2"></i> Gestion des Événements
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton toggle -->
    <div class="mb-4 text-end">
        <button id="toggleFormBtn" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter un événement
        </button>
    </div>

    <!-- Formulaire masqué par défaut -->
    <div id="eventFormCard" class="card shadow-sm mb-5 border-0 d-none">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-dark"><i class="bi bi-plus-circle me-2"></i>Créer un nouvel événement</h5>
        </div>
        <div class="card-body">
            <form id="createEventForm" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="title" class="form-control" placeholder="Titre" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="time" name="time" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12 mb-2">
                        <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="number" name="max_participants" class="form-control" placeholder="Nombre maximum de participants" min="1">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Créer l'Événement</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('admin.events.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Titre ou date (YYYY-MM-DD)" value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary">🔍 Rechercher</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">↩️ Réinitialiser</a>
            </div>
        </div>
    </form>

    <!-- Liste des événements -->
    <div id="event-container" class="row">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Image" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Pas d’image</span>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $event->title }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                        <p class="text-muted mb-2"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>
                        <p class="mb-2"><strong>Participants :</strong> {{ $event->participations_count }} / {{ $event->max_participants }}</p>
                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-outline-primary btn-sm mt-auto">
                            🔍 Détails
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Aucun événement trouvé.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formCard = document.getElementById('eventFormCard');
    const toggleBtn = document.getElementById('toggleFormBtn');

    if (toggleBtn && formCard) {
        toggleBtn.addEventListener('click', () => {
            formCard.classList.toggle('d-none');

            if (formCard.classList.contains('d-none')) {
                toggleBtn.innerHTML = '<i class="bi bi-plus-circle"></i> Ajouter un événement';
            } else {
                toggleBtn.innerHTML = '<i class="bi bi-dash-circle"></i> Masquer le formulaire';
            }
        });
    }
});
</script>
@endsection

