@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>📅 Liste des Événements</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire avec ID correct -->
    <form id="createEventForm" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
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
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-12 mb-2">
                <textarea name="description" class="form-control" placeholder="Description" required></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Créer l'Événement</button>
            </div>
        </div>
    </form>

    <!-- Conteneur pour la liste des événements -->
    <div id="event-container">
        @foreach($events as $event)
            <div class="card mb-3">
                @if($event->image)
                  <!-- <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" style="max-height:200px;" alt="Image"> -->
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Image" style="max-height:300px; width:100%; object-fit:auto;">

                @endif
                <div class="card-body">
                    <h5>{{ $event->title }}</h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>
                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-primary">🔍 Détails</a>

                
                </div>
                
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createEventForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch("{{ route('admin.events.store') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const event = data.event;
                const container = document.getElementById('event-container');
                const card = document.createElement('div');
                card.classList.add('card', 'mb-3', 'event-card');
                card.setAttribute('data-id', event.id);

                let imageHtml = '';
                if (event.image) {
                    imageHtml = `<img src="/storage/${event.image}" alt="Image">`;

                }

                card.innerHTML = `
                    ${imageHtml}
                    <div class="card-body">
                        <h5>${event.title}</h5>
                        <p>${event.description}</p>
                        <p class="text-muted">${event.date.substring(0, 10)} à ${event.time}</p>
                        <a href="/admin/events/${event.id}" class="btn btn-sm btn-primary">🔍 Détails</a>
                    </div>
                `;

                container.prepend(card);
                form.reset();
                alert('✅ Événement ajouté avec succès !');
            } else {
                alert('❌ Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            alert('❌ Une erreur est survenue.');
        });
    });
});
</script>
@endsection