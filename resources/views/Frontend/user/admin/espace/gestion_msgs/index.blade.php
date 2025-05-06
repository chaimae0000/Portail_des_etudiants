@extends('layouts.admin')

@section('content')
<div class="container mt-4">
<a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅️ Retour</a>
    <h2>📬 Messages Reçus</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($messages as $message)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">De : {{ $message->user->name }} ({{ $message->user->email }})</h5>
                <p class="card-text"><strong>Objet :</strong> {{ $message->subject }}</p>
                <p class="card-text">{{ $message->body }}</p>

                <form method="POST" action="{{ route('messages.reply', $message->id) }}">
                    @csrf
                    <div class="mb-2">
                        <textarea name="reply" class="form-control" placeholder="Votre réponse..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Répondre</button>
                </form>
            </div>
        </div>
    @empty
        <p>Aucun message reçu pour le moment.</p>
    @endforelse
</div>
@endsection
