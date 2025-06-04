@extends('layouts.member')

@section('content')
@include('layouts.preloader')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📅 Événements disponibles</h2>
        <a href="{{ route('membre.evenements') }}" class="btn btn-outline-primary">Mes événements</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('info'))
        <div class="alert alert-danger">{{ session('info') }}</div>
    @endif

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="text-muted">
                            📆 {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} à 🕒 {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                        </p>

                        @php
                            $isFull = $event->max_participants !== null && $event->participations_count >= $event->max_participants;
                        @endphp

                        @if(in_array($event->id, $participatedEventIds))
                            <button class="btn btn-success mt-auto" disabled>✅ Déjà inscrit</button>
                        @elseif($isFull)
                            <button class="btn btn-secondary mt-auto" disabled>❌ Complet</button>
                        @else
                            <form action="{{ route('membre.events.participer', $event->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Participer</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Aucun événement disponible actuellement.</div></div>
        @endforelse
    </div>
</div>
@endsection
