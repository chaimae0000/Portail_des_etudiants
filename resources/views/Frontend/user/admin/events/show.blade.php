@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails de l'événement</h1>

        <!-- Vérification des messages de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Détails de l'événement -->
        <div class="card">
            <div class="card-header">
                <h3>{{ $event->title }}</h3>
            </div>

            <div class="card-body">
                <p><strong>Description:</strong> {{ $event->description }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                <p><strong>Heure:</strong> {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Retour à la liste</a>
                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">Modifier l'événement</a>
            </div>
        </div>
    </div>
@endsection
