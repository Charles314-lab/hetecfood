@extends('adminlte::page')

@section('title', 'Créer un plat')

@section('content_header')
    <h1>Ajouter un nouveau plat</h1>
@endsection

@section('content')
    <form action="{{ route('plats.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Origine</label>
            <input type="text" name="origine" class="form-control">
        </div>
        <div class="form-group">
            <label>Temps de cuisson</label>
            <input type="text" name="tps_cuisson" class="form-control">
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Menu</label>
            <select name="menu_id" class="form-control">
                <option value="">-- Aucun --</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                <option value="">-- Aucune --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success mt-2">Enregistrer</button>
    </form>
@endsection
