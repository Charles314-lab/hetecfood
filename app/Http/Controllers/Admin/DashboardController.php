<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Plat;
use App\Models\Commande;
use App\Models\Reservation;
use App\Models\Message;
use App\Models\Livreur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
public function index()
{
    // Statistiques de base
    $stats = [
        'clients' => Client::count(),
        'plats' => Plat::count(),
        'commandes' => Commande::count(),
        'reservations' => Reservation::count(),
        'messages' => Message::count(),
        'livreurs_dispo' => Livreur::where('statut', 'disponible')->count(),
        'unreadMessages' => Message::where('status', 'non-lu')->count(),
    ];

    // Calcul des tendances
    $lastMonth = now()->subMonth();
    $stats['clientGrowth'] = $this->calculateGrowth(Client::class, $lastMonth);
    $stats['platGrowth'] = $this->calculateGrowth(Plat::class, $lastMonth);
    $stats['orderGrowth'] = $this->calculateGrowth(Commande::class, $lastMonth);
    $stats['reservationGrowth'] = $this->calculateGrowth(Reservation::class, $lastMonth);
    $stats['messageGrowth'] = $this->calculateGrowth(Message::class, $lastMonth);

    // Pourcentage de livreurs disponibles
    $totalCouriers = Livreur::count();
    $stats['availableCouriersPercentage'] = $totalCouriers > 0
        ? round(($stats['livreurs_dispo'] / $totalCouriers) * 100)
        : 0;

    // Commandes récentes
    $stats['recentOrders'] = Commande::with(['client', 'plat'])
        ->where('created_at', '>=', now()->subDays(30))
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // Données pour le graphique des commandes
    $orderStats = Commande::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $stats['orderDates'] = $orderStats->pluck('date')->map(function($date) {
        return Carbon::parse($date)->format('d M');
    });

    $stats['orderCounts'] = $orderStats->pluck('count');

    // Plats populaires
    $stats['popularPlats'] = Plat::withCount(['commandes as orders_count'])
        ->withSum('commandes as total_revenue', 'prix_total')
        ->orderBy('orders_count', 'desc')
        ->limit(5)
        ->get();

    $stats['maxOrders'] = $stats['popularPlats']->max('orders_count') ?: 1;

    // Statut des commandes
    $orderStatus = Commande::select(
            'statut',
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('statut')
        ->get();

    $stats['orderStatusLabels'] = $orderStatus->pluck('statut')->map(function($status) {
        return ucfirst($status);
    });

    $stats['orderStatusData'] = $orderStatus->pluck('count');

    return view('admin.dashboard', $stats);
}


    private function calculateGrowth($model, $since)
    {
        $table = (new $model)->getTable();

        // Vérifier si la table a une colonne created_at
        if (!Schema::hasColumn($table, 'created_at')) {
            return 0; // Retourne 0 si la colonne n'existe pas
        }

        $currentCount = $model::count();
        $previousCount = $model::where('created_at', '<', $since)->count();

        if ($previousCount === 0) {
            return $currentCount > 0 ? 100 : 0;
        }

        return round((($currentCount - $previousCount) / $previousCount) * 100);
    }
}
