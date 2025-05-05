@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des adhérents</h1>

    <!-- Tableau pour afficher les utilisateurs (adhérents) -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(is_iterable($users) && $users->isNotEmpty()) <!-- Vérifie que $users est une collection et n'est pas vide -->
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="" class="btn btn-primary">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Aucun adhérent trouvé.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
