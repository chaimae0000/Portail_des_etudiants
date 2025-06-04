@extends('layouts.admin')

@section('content')
@include('layouts.preloader')
<div class="container py-4">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">⬅ Retour à la liste des événements</a>


    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h2 class="card-title mb-3 text-primary">
                Participants – <span class="fw-bold">{{ $event->title }}</span>
            </h2>

            <p class="text-muted">
                <i class="bi bi-people-fill me-2"></i> Maximum : {{ $event->max_participants }} participants
            </p>

            @if($participants->isEmpty())
                <div class="alert alert-info">
                    Aucun participant inscrit pour le moment.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
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
                </div>
            @endif

            
        </div>
    </div>
</div>
@endsection
