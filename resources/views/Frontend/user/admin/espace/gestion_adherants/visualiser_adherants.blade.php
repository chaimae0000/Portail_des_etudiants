@extends('layouts.admin')

@section('content')
<div class="container mt-4">
<a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅️Retour</a>

    <h2 class="mb-4 text-center">👥 Liste des Adhérents</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif


    <!-- Bouton ajouter un adhérent -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAdherantModal">
            ➕ Ajouter un Adhérent
        </button>
    </div>

    @if(isset($message))
        <div class="alert alert-warning text-center">{{ $message }}</div>
    @endif

    <div class="row">
        @foreach($users as $user)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/default-user.png') }}"
                         class="rounded-circle mb-3"
                         style="width: 100px; height: 100px; object-fit: cover;" alt="photo">

                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>

                    <a href="{{ route('adherants.show', $user->id) }}" class="btn btn-primary btn-sm">👁️ Consulter</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal ajout adhérent -->
<div class="modal fade" id="createAdherantModal" tabindex="-1" aria-labelledby="createAdherantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('adherants.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Nouvel Adhérent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Créer l’Adhérent</button>
            </div>
        </form>
    </div>
</div>
@endsection
