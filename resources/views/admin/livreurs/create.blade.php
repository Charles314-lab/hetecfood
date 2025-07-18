@extends('adminlte::page')

@section('title', 'Ajouter un livreur')

@section('content_header')
    <h1>Ajouter un livreur</h1>
@endsection

@section('content')
    <form action="{{ route('livreurs.store') }}" method="POST">
        @csrf

        @include('admin.livreurs.form')

        <button class="btn btn-success mt-2">Ajouter</button>
    </form>
@endsection
