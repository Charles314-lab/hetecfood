@extends('adminlte::page')

@section('title', 'Nouvelle commande')

@section('content_header')
    <h1>Créer une commande</h1>
@endsection

@section('content')
    <form action="{{ route('commandes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Plat</label>
            <select name="plat_id" class="form-control" required>
                @foreach($plats as $plat)
                    <option value="{{ $plat->id }}">{{ $plat->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Livreur (optionnel)</label>
            <select name="livreur_id" class="form-control">
                <option value="">-- Aucun --</option>
                @foreach($livreurs as $livreur)
                    <option value="{{ $livreur->id }}">{{ $livreur->nom }} {{ $livreur->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prix total</label>
            <input type="number" name="prix_total" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Adresse de livraison</label>
            <textarea name="adr_livraison" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Statut</label>
            <select name="statut" class="form-control" required>
                @foreach($statuts as $statut)
                    <option value="{{ $statut }}">{{ ucfirst($statut) }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success mt-2">Créer la commande</button>
    </form>
@endsection
