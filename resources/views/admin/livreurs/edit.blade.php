@extends('adminlte::page')

@section('title', 'Modifier un livreur')

@section('content_header')
    <h1>Modifier un livreur</h1>
@endsection

@section('content')
    <form action="{{ route('livreurs.update', $livreur->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.livreurs.form')

        <button class="btn btn-success mt-2">Mettre à jour</button>
    </form>
@endsection
