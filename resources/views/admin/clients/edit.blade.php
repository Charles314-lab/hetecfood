@extends('adminlte::page')

@section('title', 'Modifier un client')

@section('content_header')
    <h1>Modifier le client</h1>
@endsection

@section('content')
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}">
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="tel" class="form-control" value="{{ $client->tel }}" required>
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <textarea name="adr" class="form-control" required>{{ $client->adr }}</textarea>
        </div>
        <div class="form-group">
            <label>Nouveau mot de passe (optionnel)</label>
            <input type="password" name="pwd" class="form-control">
        </div>
        <button class="btn btn-success mt-2">Mettre à jour</button>
    </form>
@endsection
