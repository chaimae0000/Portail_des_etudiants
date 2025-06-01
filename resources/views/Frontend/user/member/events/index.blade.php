@extends('layouts.member')

@section('content')
<div class="container mt-4">
    <h2>📅 Événements disponibles</h2>
    <a href="{{ route('membre.evenements') }}" class="btn btn-primary mb-3">
        Voir mes événements inscrits
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('info'))
        <div class="alert alert-danger">{{ session('info') }}</div>
    @endif

    @foreach($events as $event)
        <div class="card mb-3">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="Image">
            @endif
            <div class="card-body">
                <h5>{{ $event->title }}</h5>
                <p>{{ $event->description }}</p>
                <p class="text-muted">
                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                </p>

                @php
                    $isFull = $event->max_participants !== null && $event->participations_count >= $event->max_participants;
                @endphp

                @if(in_array($event->id, $participatedEventIds))
                    <button class="btn btn-success" disabled>✅ Déjà inscrit</button>
                @elseif($isFull)
                    <button class="btn btn-secondary" disabled>❌ Inscription complète</button>
                @else
                    <form action="{{ route('membre.events.participer', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Participer</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
