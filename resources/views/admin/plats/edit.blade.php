@extends('adminlte::page')

@section('title', 'Modifier un plat')

@section('content_header')
    <h1>Modifier le plat</h1>
@endsection

@section('content')
    <form action="{{ route('plats.update', $plat->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $plat->nom }}" required>
        </div>
        <div class="form-group">
            <label>Origine</label>
            <input type="text" name="origine" class="form-control" value="{{ $plat->origine }}">
        </div>
        <div class="form-group">
            <label>Temps de cuisson</label>
            <input type="text" name="tps_cuisson" class="form-control" value="{{ $plat->tps_cuisson }}">
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" value="{{ $plat->prix }}" required>
        </div>
        <div class="form-group">
            <label>Menu</label>
            <select name="menu_id" class="form-control">
                <option value="">-- Aucun --</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $plat->menu_id == $menu->id ? 'selected' : '' }}>
                        {{ $menu->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                <option value="">-- Aucune --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $plat->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success mt-2">Mettre à jour</button>
    </form>
@endsection
