@extends('layouts.member')

@section('content')
<h3 class="mb-4">📝 Publications de l’administrateur</h3>

@foreach ($posts as $post)
<div class="card mb-4 shadow-sm" id="post-{{ $post->id }}">
    <div class="card-body">
        <!-- Informations sur l'utilisateur -->
        <div class="d-flex align-items-center mb-3">
            <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : asset('storage/photos/default-user.png') }}"
                 alt="Photo"
                 class="rounded-circle me-2"
                 style="width: 40px; height: 40px; object-fit: cover;">
            <div>
                <strong>{{ $post->user->name }}</strong><br>
                <small class="text-muted">Posté le {{ $post->created_at->addHour()->format('d/m/Y à H:i') }}</small>
            </div>
        </div>

        <!-- Contenu du post -->
        <p>{{ $post->content }}</p>

        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: contain;">
        @endif

        <!-- Actions j’aime -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            @php
                $liked = $post->likes->contains('user_id', auth()->id());
            @endphp

            <form method="POST" action="{{ route('membre.posts.like', $post->id) }}">
                @csrf
                <button type="submit" class="btn btn-sm {{ $liked ? 'btn-danger' : 'btn-outline-primary' }}">
                    {{ $liked ? '💔 Retirer le j\'aime' : '❤️ J\'aime' }} ({{ $post->likes->count() }})
                </button>
            </form>

            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>

        <!-- Commentaires -->
        <hr>
        <h6 class="mb-2">💬 Commentaires</h6>
        <div class="mb-3">
            @forelse ($post->comments as $comment)
                <div class="mb-2">
                    <strong>{{ $comment->user->name }}</strong> : {{ $comment->content }}
                </div>
            @empty
                <div class="text-muted">Aucun commentaire.</div>
            @endforelse
        </div>

        <!-- Formulaire de commentaire -->
        <form method="POST" action="{{ route('membre.posts.comment') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="input-group">
                <input type="text" name="content" class="form-control" placeholder="Ajouter un commentaire..." required>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
