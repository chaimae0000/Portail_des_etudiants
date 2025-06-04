@extends('layouts.member')

@section('content')
@include('layouts.preloader')
<div class="container mt-4">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour</a>
    <h2 class="text-center mb-4">Mon Profil</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Affichage Photo -->
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
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Formulaire mise à jour profil --}}
            <form method="POST" action="{{ route('membre.profile.update') }}" enctype="multipart/form-data">
                @csrf
                {{-- Pas besoin de @method car c'est un POST classique pour update --}}

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   id="name" 
                                   disabled>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   id="email" 
                                   disabled>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="photoInputContainer" style="display: none;">
                            <label for="photoInput" class="form-label">Modifier la Photo de Profil</label>
                            <input type="file" 
                                   class="form-control @error('photo') is-invalid @enderror" 
                                   name="photo" 
                                   id="photoInput" 
                                   accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-warning" onclick="enableEdit()">✏️ Modifier</button>
                            <button type="submit" class="btn btn-success" id="saveBtn" style="display:none;">💾 Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Formulaire suppression du compte --}}
            <form method="POST" action="{{ route('membre.profile.destroy') }}" onsubmit="return confirm('Es-tu sûre de vouloir supprimer ton compte ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger">🗑️ Supprimer mon compte</button>
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
