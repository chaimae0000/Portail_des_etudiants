@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">📅 Liste des Événements</h1>

    @foreach($events as $event)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $event->title }}</h4>
                <p class="card-text">{{ Str::limit($event->description, 150) }}</p>
                <p class="text-muted">📆 {{ $event->date }} à {{ $event->time }}</p>
                
                <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-primary">
                    🔍 Détails
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection