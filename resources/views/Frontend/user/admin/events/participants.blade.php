
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Liste des participants pour l'événement "{{ $event->title }}"</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.events.list') }}" class="btn btn-secondary mt-3">⬅ Retour à la liste des événements</a>
    </div>
@endsection
