<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'people' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        Reservation::create([
            'nom' => $request->name,
            'email' => $request->email,
            'telephone' => $request->phone,
            'reservation_date' => $request->date,
            'reservation_time' => $request->time,
            'nb_personnes' => $request->people,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Votre réservation a été enregistrée avec succès!');
    }
}
