<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Plat;
use App\Models\Livreur;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'plat', 'livreur'])->orderByDesc('id')->get();
        return view('admin.commandes.index', compact('commandes'));
    }

    public function edit(Commande $commande)
    {
        $clients = Client::all();
        $plats = Plat::all();
        $livreurs = Livreur::all();
        $statuts = ['en attente', 'en préparation', 'en livraison', 'livrée', 'annulée'];

        return view('admin.commandes.edit', compact('commande', 'clients', 'plats', 'livreurs', 'statuts'));
    }

    public function create()
    {
        $clients = Client::all();
        $plats = Plat::all();
        $livreurs = Livreur::all();
        $statuts = ['en attente', 'en préparation', 'en livraison', 'livrée', 'annulée'];

        return view('admin.commandes.create', compact('clients', 'plats', 'livreurs', 'statuts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plat_id' => 'required|exists:plats,id',
            'livreur_id' => 'nullable|exists:livreurs,id',
            'quantite' => 'required|integer|min:1',
            'prix_total' => 'required|numeric',
            'statut' => 'required|in:en attente,en préparation,en livraison,livrée,annulée',
            'adr_livraison' => 'required|string',
        ]);

        Commande::create($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès');
    }


    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plat_id' => 'required|exists:plats,id',
            'livreur_id' => 'nullable|exists:livreurs,id',
            'quantite' => 'required|integer|min:1',
            'prix_total' => 'required|numeric',
            'statut' => 'required|in:en attente,en préparation,en livraison,livrée,annulée',
            'adr_livraison' => 'required|string',
        ]);

        $commande->update($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée');
    }
}
