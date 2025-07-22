<?php

namespace App\Http\Controllers;
use App\Models\CommandePub;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Plat;
use App\Models\Livreur;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
// Dans CommandeController.php
public function index(Request $request)
{
    $query = Commande::with(['plat', 'client', 'livreur'])
        ->orderByDesc('date_commande');

    // Filtre par type
    if ($request->has('type')) {
        if ($request->type === 'public') {
            $query->where('is_public', true);
        } elseif ($request->type === 'admin') {
            $query->where('is_public', false);
        }
    }

    // Filtre par statut
    if ($request->filled('status')) {
        $query->where('statut', $request->status);
    }

    // Filtre par date
    if ($request->filled('date')) {
        $query->whereDate('date_commande', $request->date);
    }

    $commandes = $query->paginate(10);

    return view('admin.commandes.index', compact('commandes'));
}


public function edit(Commande $commande)
{
    $clients = Client::all();
    $plats = Plat::all();
    $livreurs = Livreur::all();
    $statuts = ['en attente', 'en préparation', 'en livraison', 'livrée', 'annulée'];

    return view('admin.commandes.edit', compact(
        'commande',
        'clients',
        'plats',
        'livreurs',
        'statuts'
    ));
}
public function storePublic(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:50',
        'prenom' => 'nullable|string|max:50',
        'plat_id' => 'required|exists:plats,id',
        'quantite' => 'required|integer|min:1',
        'tel' => 'required|string|max:20',
        'adr' => 'required|string',
    ]);

    $plat = Plat::find($request->plat_id);
    $prixTotal = $plat->prix * $request->quantite;

    Commande::create([
        'plat_id' => $request->plat_id,
        'quantite' => $request->quantite,
        'prix_total' => $prixTotal,
        'statut' => 'en attente',
        'adr_livraison' => $request->adr,
        'is_public' => true,
        'customer_phone' => $request->tel,
        'customer_name' => $request->nom . ($request->prenom ? ' ' . $request->prenom : ''),
        'date_commande' => now(),
    ]);

    return back()->with('success', 'Votre commande a été enregistrée avec succès!');
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
