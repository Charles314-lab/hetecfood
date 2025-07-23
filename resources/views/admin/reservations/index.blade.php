{{-- resources/views/admin/reservations/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Liste des réservations')

@section('content_header')
    <h1>Réservations</h1>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-button label="Ajouter une réservation" class="mb-3" theme="primary" icon="fas fa-plus"
        onclick="window.location='{{ route('reservations.create') }}'" />

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nb pers.</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $r)
            <tr>
                <td>{{ $r->nom }}</td>
                <td>{{ $r->email }}</td>
                <td>{{ $r->telephone }}</td>
                <td>{{ $r->reservation_date }}</td>
                <td>{{ $r->reservation_time }}</td>
                <td>{{ $r->nb_personnes }}</td>
                <td>{{ $r->message }}</td>
                <td>
                    <a href="{{ route('reservations.edit', $r->id) }}" class="btn btn-sm btn-info">
                        ✏️
                    </a>
                    <form action="{{ route('reservations.destroy', $r->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')" type="submit">🗑</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
