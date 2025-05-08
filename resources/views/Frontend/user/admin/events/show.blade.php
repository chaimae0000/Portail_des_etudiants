@extends('layouts.admin')

@section('content')
    <div class="container">
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">⬅ Retour à la liste des événements</a>
    <!-- <a href="javascript:history.back()" class="btn btn-secondary mb-3">Retour</a> -->
        <h1>{{ $event->title }}</h1>
        @if ($event->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $event->image) }}" alt="Image de l'événement" class="img-fluid rounded">
    </div>
         @endif
        <p><strong>Description : </strong></p>
        <p>{{ $event->description }}</p>
        <p class="text-muted"><strong>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</strong> à {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>


<!-- Bouton qui déclenche l'affichage du formulaire -->
<button class="btn btn-warning mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#editForm" aria-expanded="false" aria-controls="editForm">
    <i class="bi-pencil"></i> Modifier cet événement
</button>

<!-- Formulaire caché au départ (Bootstrap collapse) -->
<div class="collapse" id="editForm">
    <div class="card card-body">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Afficher les erreurs de validation -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $event->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
    <label for="time" class="form-label">Heure de l'événement</label>
    <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', $event->time ? date('H:i', strtotime($event->time)) : '') }}" required>
    @error('time')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
            <div class="mb-3">
                <label for="image" class="form-label">Image de l'événement</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if ($event->image)
                    <p class="mt-2">Image actuelle :</p>
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Image actuelle" style="max-width: 200px;">
                @endif
            </div>
            
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>



        <!-- Formulaire de suppression -->
        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi-trash"></i> Supprimer cet événement
            </button>
        </form>

       
    </div>
@endsection
