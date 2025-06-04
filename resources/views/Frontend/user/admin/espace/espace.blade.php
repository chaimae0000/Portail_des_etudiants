@extends('layouts.admin')

@section('content')
@include('layouts.preloader')

    <div class="title-group mb-4 text-center">
        <h1 class="h2 mb-2">Espace Administrateur</h1>
        <small class="text-muted">Gérez votre application depuis cette interface.</small>
    </div>
  

    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="d-flex flex-wrap gap-5 justify-content-center">
            <!-- Tuile Adhérents -->
            <a href="{{ route('visualiser_adherants') }}" class="admin-tile bg-primary text-white shadow">
                <i class="bi bi-people-fill"></i>
                <span>Adhérents</span>
            </a>

            <!-- Tuile Messages -->
            <a href="{{ route('admin.messages.msgs') }}" class="admin-tile bg-success text-white shadow">
                <i class="bi bi-chat-dots-fill"></i>
                <span>Messages</span>
            </a>
        </div>
    </div>

    <style>
        .admin-tile {
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

        .admin-tile i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .admin-tile:hover {
            transform: translateY(-8px);
            opacity: 0.95;
        }

        .admin-tile:hover i {
            transform: scale(1.15);
        }
    </style>

@endsection
