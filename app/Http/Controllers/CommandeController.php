<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
       // validation simple :
        $validated = $request->validate([
            'plat_id' => 'required|integer|exists:plats,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'adr' => 'required|string',
            'tel' => 'required|string|max:20',
            'quantite' => 'required|integer|min:1',
        ]);

        //retour basique
        return back()->with('success', 'Commande enregistrée avec succès !');
    }
}

