@extends('layouts.member')

@section('content')
@include('layouts.preloader')
<div class="container py-4">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour</a>
    <h2>Mes conversations</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($conversations as $conversation)
        @php
            $otherUser = $conversation->user_one_id === auth()->id()
                ? $conversation->userTwo
                : $conversation->userOne;
        @endphp

        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $otherUser->name }}</strong> ({{ $otherUser->email }})
                </div>
                <a href="{{ route('membre.messages.show', $conversation->id) }}" class="btn btn-sm btn-primary">
                    Voir la conversation
                </a>
            </div>
        </div>
    @empty
        <p>Aucune conversation pour le moment.</p>
    @endforelse

    <hr>

    <h3>Envoyer un nouveau message</h3>
    <form action="{{ route('membre.messages.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="receiver_id">Destinataire</label>
            <select name="receiver_id" id="receiver_id" class="form-control" required>
                <option value="" disabled selected>-- Choisir un utilisateur --</option>
                @foreach($users as $user)
                    @if($user->id !== auth()->id())
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="body">Message</label>
            <textarea name="body" id="body" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
@endsection
