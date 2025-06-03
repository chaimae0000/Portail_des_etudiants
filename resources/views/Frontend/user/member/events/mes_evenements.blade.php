@extends('layouts.member')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary fw-bold">
        <i class="bi bi-calendar-check-fill me-2"></i> Mes Événements Inscrits
    </h2>

    @if($events->isEmpty())
        <div class="alert alert-info">
            Vous n'êtes inscrit à aucun événement pour le moment.
        </div>
    @else
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="Image" style="max-height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">Pas d’image</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">{{ $event->title }}</h5>
                            <p class="mb-1 text-muted"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                            
                            {{-- <a href="{{ route('membre.events.details', $event->id) }}" class="btn btn-outline-primary mt-auto">
                                🔍 Détails
                            </a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
