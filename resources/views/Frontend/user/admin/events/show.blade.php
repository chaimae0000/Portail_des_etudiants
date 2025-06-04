@extends('layouts.admin')

@section('content')
@include('layouts.preloader')
<div class="container py-4">
    
<a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour à la liste des événements</a>
    <div class="row g-4">
        @if ($event->image)
        <div class="col-md-5 text-center">
            <img 
                src="{{ asset('storage/' . $event->image) }}" 
                alt="Image de l'événement" 
                class="img-fluid rounded shadow-sm" 
                style="max-height: 400px; object-fit: cover;"
            >
        </div>
        @endif

        <div class="col-md-7">
            <div class="card shadow-sm rounded-3 border-0">
                <div class="card-body">
                    <h2 class="card-title text-primary fw-bold">{{ $event->title }}</h2>

                    <p class="text-muted mb-2">
                        <i class="bi bi-calendar-event me-2"></i> 
                        {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                        <i class="bi bi-clock ms-4 me-2"></i> 
                        {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                    </p>

                    <p class="card-text fs-5">{{ $event->description }}</p>

                    <p>
                        <span class="badge bg-info text-dark fs-6">
                            <i class="bi bi-people me-1"></i> 
                            {{ $event->max_participants }} participants max
                        </span>
                    </p>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#editForm">
                            <i class="bi bi-pencil"></i> Modifier
                        </button>
<a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-info">
        <i class="bi bi-people"></i> Participants
    </a>
                        

                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de modification -->
    <div class="collapse mt-5 {{ session('error') || $errors->any() ? 'show' : '' }}" id="editForm">
        <div class="card shadow-sm border-0 p-4 bg-light rounded-3">
            <h4 class="mb-4 text-primary">Modifier l'événement</h4>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Titre</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Date</label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Heure</label>
                        <input type="time" name="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $event->time ? date('H:i', strtotime($event->time)) : '') }}" required>
                        @error('time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Max participants</label>
                        <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror" value="{{ old('max_participants', $event->max_participants) }}">
                        @error('max_participants') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $event->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        @if ($event->image)
                            <p class="mt-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Image actuelle" class="img-thumbnail" style="max-width: 150px;">
                        @endif
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#editForm">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
