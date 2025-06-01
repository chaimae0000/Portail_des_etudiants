@extends('layouts.member')

@section('content')

    <div class="title-group mb-4 text-center">
        <h1 class="h2 mb-2">Espace Membre</h1>
        <small class="text-muted">Gérez votre profil et vos messages depuis cette interface.</small>
    </div>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="d-flex flex-wrap gap-5 justify-content-center">
            <!-- Tuile Profil -->
            <a href="{{ route('membre.profile.show') }}" class="member-tile bg-primary text-white shadow">
    <i class="bi bi-person-fill"></i>
    <span>Profil</span>
</a>

<a href="{{ route('membre.messages.msgs') }}" class="member-tile bg-success text-white shadow">
    <i class="bi bi-chat-dots-fill"></i>
    <span>Messages</span>
</a>

        </div>
    </div>

    <style>
        .member-tile {
            width: 220px;
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .member-tile i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .member-tile:hover {
            transform: translateY(-8px);
            opacity: 0.95;
        }

        .member-tile:hover i {
            transform: scale(1.15);
        }
    </style>

@endsection
