@extends('layouts.admin')

@section('content')
@include('layouts.preloader')
<div class="container py-4">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour</a>
    <h2>Conversation</h2>

    @foreach($conversation->messages as $message)
    <div class="mb-3 p-3 rounded 
        {{ $message->sender_id === auth()->id() ? 'bg-primary text-white text-end' : 'bg-light text-start' }}">
        <strong>{{ $message->sender->name }}</strong><br>
        <span>{{ $message->body }}</span><br>
        <small class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</small>
    </div>
@endforeach


    <hr>

    <form action="{{ route('admin.messages.reply', $conversation->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="body">Votre message</label>
            <textarea name="body" id="body" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Répondre</button>
    </form>
</div>
@endsection
