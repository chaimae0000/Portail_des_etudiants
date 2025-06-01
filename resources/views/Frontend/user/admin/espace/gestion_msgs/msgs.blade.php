@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour</a>
    <h2>Envoyer un message</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.messages.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="receiver_id">Choisir un utilisateur</label>
            <select name="receiver_id" id="receiver_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionner un destinataire --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="body">Message</label>
            <textarea name="body" class="form-control" id="body" rows="4" placeholder="Écrivez votre message ici..." required>{{ old('body') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <hr>

    <h3>Messages échangés</h3>
    @forelse($messages as $message)
        <div class="card-body">
                <h5>De : {{ $message->sender->name }} ({{ $message->sender->email }})</h5>
                <p><strong>Message :</strong> {{ $message->body }}</p>

                <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-2">
                        <textarea name="reply" class="form-control" placeholder="Votre réponse..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Répondre</button>
                </form>
            </div>
    @empty
        <p>Aucun message échangé.</p>
    @endforelse

</div>
@endsection
