@extends('adminlte::page')

@section('title', 'Créer un Menu')

@section('content_header')
    <h1>Créer un nouveau Menu</h1>
@endsection

@section('content')
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom du menu</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Enregistrer</button>
    </form>
@endsection
