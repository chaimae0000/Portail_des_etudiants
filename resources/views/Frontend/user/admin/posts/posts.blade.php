@extends('layouts.admin')

@section('content')
<a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅Retour</a>
<!-- Formulaire de création d'un nouveau post -->
<div class="card shadow-sm rounded mb-5">
    
    <div class="card-body">
        <h4 class="card-title mb-3">📝 Créer un nouveau post</h4>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Exprimez-vous..." rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-upload"></i> Publier
            </button>
        </form>
    </div>
</div>

<!-- Liste des posts -->
<div class="posts-container">
    @foreach ($posts as $post)
    <div class="card shadow-sm rounded mb-4" id="post-{{ $post->id }}">
        <div class="card-body">
            <!-- Header utilisateur + actions -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : asset('storage/photos/default-user.png') }}"
                         class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
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

            <!-- Contenu du post -->
            <div class="post-content-{{ $post->id }}">
                <p class="card-text">{{ $post->content }}</p>
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="post-image">

                @endif
            </div>

            <!-- Formulaire de modification -->
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
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="post-image">


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
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-sm">💾 Enregistrer</button>
                        <button type="button" class="btn btn-secondary btn-sm cancel-edit" data-post-id="{{ $post->id }}">❌ Annuler</button>
                    </div>
                </form>
            </div>

            <!-- Actions post -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                @php
                    $alreadyLiked = $post->likes->where('user_id', auth()->id())->count() > 0;
                @endphp

                @if ($alreadyLiked)
                    <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            💔 Retirer le j’aime ({{ $post->likes->count() }})
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('posts.like', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            ❤️ J’aime ({{ $post->likes->count() }})
                        </button>
                    </form>
                @endif

                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>

            <!-- Commentaires -->
            <hr>
            <h6 class="mb-3">💬 Commentaires</h6>
            <div class="mb-3">
                @forelse ($post->comments as $comment)
                    <div class="mb-2">
                        <strong>{{ $comment->user->name }}</strong> : {{ $comment->content }}
                    </div>
                @empty
                    <div class="text-muted">Aucun commentaire.</div>
                @endforelse
            </div>
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Ajouter un commentaire">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

<!-- JS pour basculer entre affichage/édition -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-post-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.postId;
                document.querySelector(`.post-content-${id}`).style.display = 'none';
                document.querySelector(`.edit-form-${id}`).style.display = 'block';
            });
        });

        document.querySelectorAll('.cancel-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.postId;
                document.querySelector(`.post-content-${id}`).style.display = 'block';
                document.querySelector(`.edit-form-${id}`).style.display = 'none';
            });
        });
    });
</script>
<style>
    .post-image {
        max-width: 100%;
        max-height: 400px;
        width: auto;
        height: auto;
        display: block;
        margin: 10px auto;
        border-radius: 10px;
        object-fit: contain;
    }
</style>



@endsection
