@extends('adminlte::page')

@section('title', 'Gestion des commandes')

@section('content_header')
    <h1>Liste des commandes</h1>
@stop

@section('content')
    {{-- Section Filtres --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filtrer les commandes</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('commandes.index') }}" method="GET" class="row g-3">
                {{-- Filtres comme montré ci-dessus --}}
                ...
            </form>
        </div>
    </div>

    {{-- Tableau des commandes --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Plat</th>
                            <th>Quantité</th>
                            <th>Prix total</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>
                                @if($commande->client_id)
                                    {{ $commande->client->nom ?? 'Client supprimé' }}
                                @else
                                    {{ $commande->customer_name }} (Public)
                                @endif
                                <br>
                                <small>{{ $commande->client_phone }}</small>
                            </td>
                            <td>{{ $commande->plat->nom ?? 'Plat supprimé' }}</td>
                            <td>{{ $commande->quantite }}</td>
                            <td>{{ number_format($commande->prix_total, 0, ',', ' ') }} FCFA</td>
                            <td>
                                <span class="badge bg-{{ $commande->statut == 'livrée' ? 'success' : ($commande->statut == 'annulée' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($commande->statut) }}
                                </span>
                            </td>
                            <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $commande->is_public ? 'info' : 'primary' }}">
                                    {{ $commande->is_public ? 'Publique' : 'Admin' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $commandes->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .badge {
            font-size: 0.85em;
            font-weight: 500;
        }
    </style>
@stop
