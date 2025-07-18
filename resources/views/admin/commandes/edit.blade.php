@extends('adminlte::page')

@section('title', 'Modifier une commande')

@section('content_header')
    <h1>Modifier la commande</h1>
@endsection

@section('content')
    <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }} {{ $client->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Plat</label>
            <select name="plat_id" class="form-control" required>
                @foreach($plats as $plat)
                    <option value="{{ $plat->id }}" {{ $commande->plat_id == $plat->id ? 'selected' : '' }}>
                        {{ $plat->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Livreur</label>
            <select name="livreur_id" class="form-control">
                <option value="">-- Aucun --</option>
                @foreach($livreurs as $livreur)
                    <option value="{{ $livreur->id }}" {{ $commande->livreur_id == $livreur->id ? 'selected' : '' }}>
                        {{ $livreur->nom }} {{ $livreur->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" value="{{ $commande->quantite }}" required>
        </div>

        <div class="form-group">
            <label>Prix total</label>
            <input type="number" name="prix_total" class="form-control" value="{{ $commande->prix_total }}" required>
        </div>

        <div class="form-group">
            <label>Adresse de livraison</label>
            <textarea name="adr_livraison" class="form-control" required>{{ $commande->adr_livraison }}</textarea>
        </div>

        <div class="form-group">
            <label>Statut</label>
            <select name="statut" class="form-control" required>
                @foreach($statuts as $statut)
                    <option value="{{ $statut }}" {{ $commande->statut == $statut ? 'selected' : '' }}>
                        {{ ucfirst($statut) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success mt-2">Mettre à jour</button>
    </form>
@endsection
