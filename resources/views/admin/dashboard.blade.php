@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0 text-dark">
                <i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord
            </h1>
            <small class="text-muted">Dernière mise à jour: {{ now()->format('d/m/Y H:i') }}</small>
        </div>
        <div>
            <button class="btn btn-sm btn-outline-secondary" id="refresh-btn">
                <i class="fas fa-sync-alt"></i> Actualiser
            </button>
        </div>
    </div>
@stop

@section('content')
    <div class="row mb-4">
        <!-- Cartes de statistiques -->
        <x-adminlte-info-box
            title="Clients"
            text="{{ $clients }}"
            icon="fas fa-users"
            theme="info"
            class="col-md-4"
            progress="{{ $clientGrowth ?? 0 }}%"
            progress-description="Croissance mensuelle"
        />

        <x-adminlte-info-box
            title="Plats"
            text="{{ $plats }}"
            icon="fas fa-utensils"
            theme="danger"
            class="col-md-4"
            progress="{{ $platGrowth ?? 0 }}%"
            progress-description="Nouveaux ce mois"
        />

        <x-adminlte-info-box
            title="Commandes"
            text="{{ $commandes }}"
            icon="fas fa-shopping-cart"
            theme="success"
            class="col-md-4"
            progress="{{ $orderGrowth ?? 0 }}%"
            progress-description="Augmentation"
        />

        <x-adminlte-info-box
            title="Réservations"
            text="{{ $reservations }}"
            icon="fas fa-calendar-check"
            theme="primary"
            class="col-md-4"
            progress="{{ $reservationGrowth ?? 0 }}%"
            progress-description="Ce mois"
        />

        <x-adminlte-info-box
            title="Messages"
            text="{{ $messages }}"
            icon="fas fa-envelope"
            theme="warning"
            class="col-md-4"
            progress="{{ $messageGrowth ?? 0 }}%"
            progress-description="Non lus: {{ $unreadMessages ?? 0 }}"
        />

        <x-adminlte-info-box
            title="Livreurs disponibles"
            text="{{ $livreurs_dispo }}"
            icon="fas fa-truck"
            theme="teal"
            class="col-md-4"
            progress="{{ $availableCouriersPercentage ?? 0 }}%"
            progress-description="Disponibles"
        />
    </div>

    <div class="row">
        <!-- Graphique des commandes récentes -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Commandes récentes (30 jours)</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="ordersChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Dernières commandes -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dernières commandes</h3>
                    <div class="card-tools">
                        <span class="badge badge-danger">{{ $recentOrders->count() ?? 0 }} nouvelles</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($recentOrders as $order)
                            <li class="item">
                                <div class="product-info">
                                    <a href="{{ route('commandes.edit', $order->id) }}" class="product-title">
                                        {{ $order->plat->nom ?? 'Plat supprimé' }}
                                        <span class="badge badge-{{ $order->statut == 'livrée' ? 'success' : ($order->statut == 'annulée' ? 'danger' : 'warning') }} float-right">
                                            {{ ucfirst($order->statut) }}
                                        </span>
                                    </a>
                                    <span class="product-description">
                                        {{ $order->client->nom ?? 'Client supprimé' }} - {{ $order->prix_total }} FCFA
                                        <small class="text-muted float-right">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</small>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('commandes.index') }}" class="uppercase">Voir toutes les commandes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Plats populaires -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Plats les plus populaires</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Plat</th>
                                    <th>Commandes</th>
                                    <th>Revenu</th>
                                    <th>Popularité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularPlats as $plat)
                                    <tr>
                                        <td>{{ $plat->nom }}</td>
                                        <td>{{ $plat->orders_count }}</td>
                                        <td>{{ $plat->total_revenue }} FCFA</td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-{{ $loop->index < 3 ? 'success' : 'info' }}"
                                                    style="width: {{ ($plat->orders_count / $maxOrders) * 100 }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statuts des commandes -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statut des commandes</h3>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
    <style>
        .card {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .progress-xs {
            height: 7px;
        }

        .border-left-info {
            border-left: 4px solid #17a2b8 !important;
        }

        .border-left-success {
            border-left: 4px solid #28a745 !important;
        }

        .border-left-primary {
            border-left: 4px solid #007bff !important;
        }

        .border-left-warning {
            border-left: 4px solid #ffc107 !important;
        }

        .border-left-danger {
            border-left: 4px solid #dc3545 !important;
        }

        .border-left-teal {
            border-left: 4px solid #20c997 !important;
        }

        .products-list .product-info {
            margin-left: 0;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        $(document).ready(function () {
            const ordersCtx = document.getElementById('ordersChart').getContext('2d');
            new Chart(ordersCtx, {
                type: 'line',
                data: {
                    labels: @json($orderDates),
                    datasets: [{
                        label: 'Commandes',
                        data: @json($orderCounts),
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($orderStatusLabels),
                    datasets: [{
                        data: @json($orderStatusData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });

            $('#refresh-btn').click(() => window.location.reload());
        });
    </script>
@endsection
