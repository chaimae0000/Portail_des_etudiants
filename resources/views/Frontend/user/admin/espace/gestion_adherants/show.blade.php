@extends('layouts.admin')

@section('content')
@include('layouts.preloader')
<div class="container mt-4">
<a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour</a>
    <h2 class="text-center mb-4">Détails de l'Adhérent</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Display Photo -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <label>Photo de Profil</label><br>
                    <img id="photoPreview"
                         src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/default-user.png') }}" 
                         alt="Photo de profil" 
                         class="rounded-circle mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form method="POST" action="{{ route('adherants.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" disabled>
                        </div>

                        <div class="mb-3" id="photoInputContainer" style="display: none;">
                            <label for="photoInput" class="form-label">Modifier la Photo de Profil</label>
                            <input type="file" class="form-control" name="photo" id="photoInput">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-warning" onclick="enableEdit()">✏️ Modifier</button>
                            <button type="submit" class="btn btn-success" id="saveBtn" style="display:none;">💾 Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('adherants.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?')">🗑️ Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function enableEdit() {
        document.getElementById('name').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('photoInputContainer').style.display = 'block';
        document.getElementById('saveBtn').style.display = 'inline-block';
    }

    // Aperçu de la nouvelle photo
    document.getElementById('photoInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('photoPreview').src = URL.createObjectURL(file);
        }
    });
</script>
@endsection
