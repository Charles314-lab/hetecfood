@extends('adminlte::page')

@section('title', 'Livreurs')

@section('content_header')
    <h1>Liste des livreurs</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('livreurs.create') }}" class="btn btn-primary mb-3">Ajouter un livreur</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livreurs as $livreur)
                <tr>
                    <td>{{ $livreur->nom }}</td>
                    <td>{{ $livreur->prenom }}</td>
                    <td>{{ $livreur->email }}</td>
                    <td>{{ $livreur->tel }}</td>
                    <td>
                        <span class="badge bg-{{ $livreur->statut == 'disponible' ? 'success' : ($livreur->statut == 'en livraison' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($livreur->statut) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('livreurs.edit', $livreur->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('livreurs.destroy', $livreur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce livreur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
