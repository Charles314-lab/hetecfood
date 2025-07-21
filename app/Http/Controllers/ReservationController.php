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
        $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telephone' => 'required|string|max:20',
            'nb_personnes' => 'nullable|integer',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'message' => 'nullable|string',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
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
