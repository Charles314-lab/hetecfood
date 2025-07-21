@extends('adminlte::page')

@section('title', 'Créer un client')

@section('content_header')
    <h1>Ajouter un nouveau client</h1>
@endsection

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="tel" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <textarea name="adr" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Mot de passe (optionnel)</label>
            <input type="password" name="pwd" class="form-control">
        </div>
        <button class="btn btn-success mt-2">Enregistrer</button>
    </form>
@endsection
