<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Plat;
use App\Models\Commande;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Livreur;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'clients' => Client::count(),
            'plats' => Plat::count(),
            'commandes' => Commande::count(),
            'reservations' => Reservation::count(),
            'messages' => Message::count(),
            'livreurs_dispo' => Livreur::where('statut', 'disponible')->count(),
        ]);
    }
}
