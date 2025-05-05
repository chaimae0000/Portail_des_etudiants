@extends('layouts.admin')
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>{{ $event->title }}</h2>
    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid mb-3" alt="Image de l'événement">
    <p>{{ $event->description }}</p>
    <p class="text-muted">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</p>

    <a href="{{ route('events.list') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
