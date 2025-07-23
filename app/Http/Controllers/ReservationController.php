<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('admin.reservations.create');
    }

    public function store(Request $request)
    {
        // Validation adaptative pour compatibilité front/back
        $validated = $request->validate([
            'nom' => 'nullable|string|max:100',
            'name' => 'nullable|string|max:100',
            'email' => 'required|email|max:100',
            'telephone' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'nb_personnes' => 'nullable|integer|min:1',
            'people' => 'nullable|integer|min:1',
            'reservation_date' => 'nullable|date',
            'date' => 'nullable|date',
            'reservation_time' => 'nullable',
            'time' => 'nullable',
            'message' => 'nullable|string',
        ]);

        Reservation::create([
            'nom' => $request->nom ?? $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone ?? $request->phone,
            'reservation_date' => $request->reservation_date ?? $request->date,
            'reservation_time' => $request->reservation_time ?? $request->time,
            'nb_personnes' => $request->nb_personnes ?? $request->people,
            'message' => $request->message,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation enregistrée avec succès.');
    }

    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telephone' => 'required|string|max:20',
            'nb_personnes' => 'nullable|integer',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'message' => 'nullable|string',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }
}
