<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    public function index()
    {
        $livreurs = Livreur::all();
        return view('admin.livreurs.index', compact('livreurs'));
    }

    public function create()
    {
        $statuts = ['disponible', 'indisponible', 'en livraison'];
        return view('admin.livreurs.create', compact('statuts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:livreurs,email',
            'tel' => 'required|string|max:20',
            'adr' => 'required|string|max:50',
            'statut' => 'required|in:disponible,indisponible,en livraison',
        ]);

        Livreur::create($request->all());

        return redirect()->route('livreurs.index')->with('success', 'Livreur ajouté avec succès');
    }

    public function edit(Livreur $livreur)
    {
        $statuts = ['disponible', 'indisponible', 'en livraison'];
        return view('admin.livreurs.edit', compact('livreur', 'statuts'));
    }

    public function update(Request $request, Livreur $livreur)
    {
        $request->validate([
    'nom' => 'required|string|max:50',
    'prenom' => 'required|string|max:50',
    'email' => 'required|email|unique:livreurs,email',
    'tel' => 'required|string|max:20',
    'adr' => 'nullable|string|max:100',
    'date_embauche' => 'nullable|date',
    'statut' => 'required|in:disponible,indisponible,en livraison',
]);


        $livreur->update($request->all());

        return redirect()->route('livreurs.index')->with('success', 'Livreur mis à jour');
    }

    public function destroy(Livreur $livreur)
    {
        $livreur->delete();
        return redirect()->route('livreurs.index')->with('success', 'Livreur supprimé');
    }
}
