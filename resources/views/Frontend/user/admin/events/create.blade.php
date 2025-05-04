<!-- resources/views/admin/events/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Créer un événement</h1>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="time">Heure</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
@endsection
