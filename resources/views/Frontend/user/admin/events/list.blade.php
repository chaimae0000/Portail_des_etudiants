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
                <form id="createEventForm" method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
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
    let page = 1;
    const loading = document.getElementById('loading');

    window.onscroll = function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
            loadMoreEvents();
        }
    };

    function loadMoreEvents() {
        page++;

        loading.style.display = 'block';

        fetch(`/admin/events?page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.events.length) {
                    const eventContainer = document.getElementById('event-container');
                    data.events.forEach(event => {
                        const eventCard = document.createElement('div');
                        eventCard.classList.add('card', 'mb-3', 'event-card');
                        eventCard.dataset.id = event.id;

                        if (event.image) {
                            eventCard.innerHTML = `
                                <img src="${event.image}" class="card-img-top" alt="Image de l’événement">
                                <div class="card-body">
                                    <h5>${event.title}</h5>
                                    <p>${event.description}</p>
                                    <p class="text-muted">${event.date} à ${event.time}</p>
                                    <a href="/admin/events/${event.id}" class="btn btn-sm btn-primary">🔍 Détails</a>
                                </div>
                            `;
                        } else {
                            eventCard.innerHTML = `
                                <div class="card-body">
                                    <h5>${event.title}</h5>
                                    <p>${event.description}</p>
                                    <p class="text-muted">${event.date} à ${event.time}</p>
                                    <a href="/admin/events/${event.id}" class="btn btn-sm btn-primary">🔍 Détails</a>
                                </div>
                            `;
                        }

                        eventContainer.appendChild(eventCard);
                    });

                    if (!data.next_page) {
                        loading.innerHTML = 'Plus d\'événements à afficher.';
                    }
                } else {
                    loading.innerHTML = 'Il n\'y a plus d\'événements à charger.';
                }

                loading.style.display = 'none';
            })
            .catch(error => {
                console.error('Erreur lors du chargement des événements:', error);
                loading.style.display = 'none';
            });
    }

    // Handle form submission
    const createEventForm = document.getElementById('createEventForm');
    createEventForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(createEventForm);

        fetch('/admin/events', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal and reset the form
                $('#createEventModal').modal('hide');
                createEventForm.reset();
                alert('Événement créé avec succès');
                location.reload();  // Reload the page to show the new event
            } else {
                alert('Erreur lors de la création de l\'événement');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    });
</script>
@endsection
