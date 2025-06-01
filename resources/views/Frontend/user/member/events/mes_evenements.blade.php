@extends('layouts.member')

@section('content')
    <h2>Mes Événements Inscrits</h2>

    @if($events->isEmpty())
        <p>Vous n'êtes inscrit à aucun événement.</p>
    @else
        <ul>
            @foreach($events as $event)
                <li>
                    <strong>{{ $event->title }}</strong><br>
                    Date : {{ $event->date }}<br>
                    Statut : {{ $event->pivot->status }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
