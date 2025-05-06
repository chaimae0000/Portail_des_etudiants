@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Détails de l'Adhérent</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Display Photo -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <label>Photo de Profil</label><br>
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/default-user.png')
 }}" 
                         alt="Photo de profil" 
                         class="rounded-circle mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form method="POST" action="{{ route('adherants.update', $user->id) }}">
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
        document.getElementById('saveBtn').style.display = 'inline-block';
    }
</script>
@endsection
