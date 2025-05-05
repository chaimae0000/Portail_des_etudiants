@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Détails de l'Adhérent</h2>

    <form method="POST" action="{{ route('adherants.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" disabled>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" disabled>
        </div>

        <button type="button" class="btn btn-warning" onclick="enableEdit()">✏️ Modifier</button>
        <button type="submit" class="btn btn-success" id="saveBtn" style="display:none;">💾 Enregistrer</button>
    </form>

    <form method="POST" action="{{ route('adherants.destroy', $user->id) }}" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?')">🗑️ Supprimer</button>
    </form>
</div>

<script>
    function enableEdit() {
        document.getElementById('name').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('saveBtn').style.display = 'inline-block';
    }
</script>
@endsection
