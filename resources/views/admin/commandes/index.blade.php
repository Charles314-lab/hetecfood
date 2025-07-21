@extends('adminlte::page')

@section('title', 'Commandes')

@section('content_header')
    <h1>Liste des Commandes</h1>
@endsection

@section('content')

<a href="{{ route('commandes.create') }}" class="btn btn-primary mb-3">Nouvelle commande</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Plat</th>
                <th>Quantité</th>
                <th>Prix Total</th>
                <th>Statut</th>
                <th>Livreur</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td>{{ $commande->plat->nom }}</td>
                    <td>{{ $commande->quantite }}</td>
                    <td>{{ $commande->prix_total }} FCFA</td>
                    <td>{{ ucfirst($commande->statut) }}</td>
                    <td>{{ $commande->livreur->nom ?? '-' }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>
                        <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette commande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
