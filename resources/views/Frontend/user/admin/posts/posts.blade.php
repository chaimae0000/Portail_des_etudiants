@extends('layouts.admin')
@section('content')


<!-- Formulaire de création d’un nouveau post (toujours en haut) -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Créer un nouveau post</h5>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Exprimez-vous..." rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">Publier</button>
        </form>
    </div>
</div>

@foreach ($posts as $post)
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : asset('storage/photos/default-user.png') }}"
                 alt="Photo de profil" 
                 class="rounded-circle me-2"
                 style="width: 40px; height: 40px; object-fit: cover;">
            <div>
                <strong>{{ $post->user->name }}</strong><br>
                <small class="text-muted">Posté le {{ $post->created_at->addHour()->format('d/m/Y à H:i') }}</small>
            </div>
        </div>

        <p class="card-text">{{ $post->content }}</p>
        
        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid rounded mb-2">
        @endif

        <div class="d-flex justify-content-between">
            @php
                $alreadyLiked = $post->likes->where('user_id', auth()->id())->count() > 0;
            @endphp

            @if ($alreadyLiked)
                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">💔 Retirer le j'aime ({{ $post->likes->count() }})</button>
                </form>
            @else
                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm" type="submit">❤️ J'aime ({{ $post->likes->count() }})</button>
                </form>
            @endif

            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
        </div>

        <hr>
        <h6>Commentaires :</h6>
        @foreach ($post->comments as $comment)
            <div class="mb-2">
                <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
            </div>
        @endforeach

        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="input-group mt-2">
                <input type="text" name="content" class="form-control" placeholder="Ajouter un commentaire">
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
