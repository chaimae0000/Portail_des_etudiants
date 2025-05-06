@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>👥 Liste des Adhérents</h2>

    <!-- Display success message if exists -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Button to trigger the modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createAdherantModal">➕ Ajouter un Adhérent</button>

    <!-- Adherant List -->
    <div id="adherant-container">
        @foreach($users as $user)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $user->name }}</h5>
                <p>{{ $user->email }}</p>
                <a href="{{ route('adherants.show', $user->id) }}" class="btn btn-primary btn-sm">👁️ Consulter</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal for creating an adherant -->
<div class="modal fade" id="createAdherantModal" tabindex="-1" aria-labelledby="createAdherantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('adherants.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createAdherantModalLabel">Ajouter un Nouvel Adhérent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil</label>
                    <input type="file" class="form-control" name="photo" id="photo" accept="image/*">

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Créer l’Adhérent</button>
            </div>
        </form>
    </div>
</div>
@endsection
