@extends('adminlte::page')

@section('title', 'Plats')

@section('content_header')
    <h1>Liste des plats</h1>
@endsection

@section('content')
    <a href="{{ route('plats.create') }}" class="btn btn-primary mb-3">Ajouter un plat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Origine</th>
                <th>Prix</th>
                <th>Menu</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plats as $plat)
                <tr>
                    <td>{{ $plat->id }}</td>
                    <td>{{ $plat->nom }}</td>
                    <td>{{ $plat->origine }}</td>
                    <td>{{ $plat->prix }} FCFA</td>
                    <td>{{ $plat->menu->nom ?? '-' }}</td>
                    <td>{{ $plat->categorie->nom ?? '-' }}</td>
                    <td>
                        <a href="{{ route('plats.edit', $plat->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('plats.destroy', $plat->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce plat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
