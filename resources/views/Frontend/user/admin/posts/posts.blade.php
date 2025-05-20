@extends('layouts.admin')
@section('content')

<!-- Style pour corriger le problème de double scrollbar -->

<!-- Formulaire de création d'un nouveau post (toujours en haut) -->
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

<!-- Liste des posts dans un conteneur avec scrolling unique -->
<div class="posts-container">
    @foreach ($posts as $post)
    <div class="card mb-4 shadow-sm" id="post-{{ $post->id }}">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : asset('storage/photos/default-user.png') }}"
                         alt="Photo de profil" 
                         class="rounded-circle me-2"
                         style="width: 40px; height: 40px; object-fit: cover;">
                    <div>
                        <strong>{{ $post->user->name }}</strong><br>
                        <small class="text-muted">Posté le {{ $post->created_at->addHour()->format('d/m/Y à H:i') }}</small>
                    </div>
                </div>
                
                @if(Auth::id() === $post->user_id)
                <div>
                    <button class="btn btn-sm btn-primary edit-post-btn" data-post-id="{{ $post->id }}">
                        <i class="bi-pencil-fill"></i> Modifier
                    </button>
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-inline delete-post-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">
                            <i class="bi-trash-fill"></i> Supprimer
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Contenu normal du post (visible par défaut) -->
            <div class="post-content-{{ $post->id }}">
                <p class="card-text">{{ $post->content }}</p>
                
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid rounded mb-2">
                @endif
            </div>

            <!-- Formulaire de modification (caché par défaut) -->
            <div class="edit-form-{{ $post->id }}" style="display: none;">
                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <textarea name="content" class="form-control" rows="3" required>{{ $post->content }}</textarea>
                    </div>
                    <div class="mb-3">
                        @if ($post->image_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image actuelle" style="max-height: 100px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_image" id="delete-image-{{ $post->id }}">
                                    <label class="form-check-label" for="delete-image-{{ $post->id }}">
                                        Supprimer l'image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-secondary cancel-edit" data-post-id="{{ $post->id }}">Annuler</button>
                </form>
            </div>

            <div class="d-flex justify-content-between mt-3">
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Boutons pour modifier un post
        const editButtons = document.querySelectorAll('.edit-post-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                document.querySelector(`.post-content-${postId}`).style.display = 'none';
                document.querySelector(`.edit-form-${postId}`).style.display = 'block';
            });
        });

        // Boutons pour annuler la modification
        const cancelButtons = document.querySelectorAll('.cancel-edit');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                document.querySelector(`.post-content-${postId}`).style.display = 'block';
                document.querySelector(`.edit-form-${postId}`).style.display = 'none';
            });
        });
    });
</script>
@endsection