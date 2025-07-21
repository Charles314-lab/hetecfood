{{-- resources/views/admin/reservations/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Créer une réservation')

@section('content_header')
    <h1>Ajouter une réservation</h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <x-adminlte-input name="nom" label="Nom" value="{{ old('nom') }}" required />
        <x-adminlte-input name="email" label="Email" value="{{ old('email') }}" required />
        <x-adminlte-input name="telephone" label="Téléphone" value="{{ old('telephone') }}" required />
        <x-adminlte-input name="nb_personnes" label="Nombre de personnes" type="number" value="{{ old('nb_personnes') }}" />
        <x-adminlte-input name="reservation_date" label="Date de réservation" type="date" value="{{ old('reservation_date') }}" required />
        <x-adminlte-input name="reservation_time" label="Heure de réservation" type="time" value="{{ old('reservation_time') }}" required />
        <x-adminlte-textarea name="message" label="Message">{{ old('message') }}</x-adminlte-textarea>

        <x-adminlte-button label="Enregistrer" type="submit" theme="success" />
    </form>
@endsection
