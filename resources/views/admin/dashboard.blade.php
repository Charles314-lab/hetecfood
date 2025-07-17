@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <h1>Bienvenue sur le tableau de bord</h1>
@endsection

@section('content')
    <div class="row">
        <x-adminlte-info-box title="Clients" text="{{ $clients }}" icon="fas fa-users" theme="info" class="col-md-4"/>
        <x-adminlte-info-box title="Plats" text="{{ $plats }}" icon="fas fa-utensils" theme="danger" class="col-md-4"/>
        <x-adminlte-info-box title="Commandes" text="{{ $commandes }}" icon="fas fa-shopping-cart" theme="success" class="col-md-4"/>
        <x-adminlte-info-box title="Réservations" text="{{ $reservations }}" icon="fas fa-calendar-check" theme="primary" class="col-md-4"/>
        <x-adminlte-info-box title="Messages" text="{{ $messages }}" icon="fas fa-envelope" theme="warning" class="col-md-4"/>
        <x-adminlte-info-box title="Livreurs disponibles" text="{{ $livreurs_dispo }}" icon="fas fa-truck" theme="teal" class="col-md-4"/>
    </div>
@endsection
