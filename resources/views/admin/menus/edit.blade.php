@extends('adminlte::page')

@section('title', 'Modifier un Menu')

@section('content_header')
    <h1>Modifier le Menu</h1>
@endsection

@section('content')
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom du menu</label>
            <input type="text" name="nom" class="form-control" value="{{ $menu->nom }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Mettre à jour</button>
    </form>
@endsection
