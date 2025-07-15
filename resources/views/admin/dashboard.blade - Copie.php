{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>--}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin - Dashboard</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --background-color: #000000;
            --default-color: rgba(255, 255, 255, 0.8);
            --heading-color: #ffffff;
            --accent-color: #ff114d;
            --surface-color: #1e1e1e;
        }

        body {
            background-color: var(--background-color);
            color: var(--default-color);
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--surface-color);
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #333;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar a {
            color: var(--default-color);
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: var(--accent-color);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: var(--accent-color);
            color: white;
            font-weight: bold;
        }

        .sidebar i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar .section-title {
            margin: 1rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #888;
            border-top: 1px solid #444;
            padding-top: 0.5rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .navbar {
            margin-left: 250px;
            background-color: var(--surface-color);
            border-bottom: 1px solid #444;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .stat-card {
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .card {
            background-color: var(--surface-color);
            border: 1px solid #333;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: rgba(0,0,0,0.2);
            border-bottom: 1px solid #333;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.visible {
                transform: translateX(0);
            }

            .navbar, .main-content {
                margin-left: 0;
            }

            .hamburger-btn {
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1100;
                background: var(--accent-color);
                border: none;
                padding: 10px;
                border-radius: 50%;
            }
        }
    </style>
</head>
<body>

<!-- Hamburger Button (mobile) -->
<button class="hamburger-btn d-md-none btn btn-primary" id="hamburgerBtn">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="text-center mb-4 px-3 py-3">
        <img src="{{ asset('assets/img/logo-montego.png') }}" alt="Logo Restaurant" class="img-fluid" style="max-height: 60px;">
        <h5 class="mt-2 text-white">Mon Restaurant</h5>
        <hr style="border-color: #555;">
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      {{--


      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('plats.index') }}" class="{{ request()->routeIs('plats.*') ? 'active' : '' }}"><i class="bi bi-egg-fried"></i> Plats</a>
    <a href="{{ route('boissons.index') }}" class="{{ request()->routeIs('boissons.*') ? 'active' : '' }}"><i class="bi bi-cup-straw"></i> Boissons</a>

    <div class="section-title">Gestion</div>
    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Catégories</a>
    <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Clients</a>
    <a href="{{ route('livreurs.index') }}" class="{{ request()->routeIs('livreurs.*') ? 'active' : '' }}"><i class="bi bi-truck"></i> Livreurs</a>
    <a href="{{ route('ingredients.index') }}" class="{{ request()->routeIs('ingredients.*') ? 'active' : '' }}"><i class="bi bi-basket2"></i> Ingrédients</a>
    <a href="{{ route('commandepubs.index') }}" class="{{ request()->routeIs('commandepubs.*') ? 'active' : '' }}"><i class="bi bi-card-checklist"></i> Commandepubs</a>
    <a href="{{ route('menus.index') }}" class="{{ request()->routeIs('menus.*') ? 'active' : '' }}"><i class="bi bi-list-check"></i> Menus</a>
    <a href="{{ route('reservations.index') }}" class="{{ request()->routeIs('reservations.*') ? 'active' : '' }}"><i class="bi bi-calendar-check"></i> Réservations</a>

    <div class="section-title">Compte</div>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-left"></i> Déconnexion
    </a>

      --}}

    </form>
</div>

{{-- @include('layouts.navbar') --}}

<!-- Main Content -->
<div class="main-content">
    <div class="container-fluid">
        <!-- Stats Cards Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-primary bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-egg-fried fs-1 me-3"></i>
                            <div>
                                <h6 class="card-subtitle mb-1">Plats</h6>
                                <h2 class="m-0">{{-- $totalPlats --}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-info bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-cup-straw fs-1 me-3"></i>
                            <div>
                                <h6 class="card-subtitle mb-1">Boissons</h6>
                                <h2 class="m-0">{{-- $totalBoissons --}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-success bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people fs-1 me-3"></i>
                            <div>
                                <h6 class="card-subtitle mb-1">Clients</h6>
                                <h2 class="m-0">{{-- $totalClients --}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card stat-card bg-warning bg-gradient text-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-truck fs-1 me-3"></i>
                            <div>
                                <h6 class="card-subtitle mb-1">Livreurs</h6>
                                <h2 class="m-0">{{-- $totalLivreurs --}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Charts Row -->
        <div class="row g-4">
            <!-- Commandes Chart -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span style="color: #fff">Commandes récentes</span>
                        <select class="form-select form-select-sm w-auto" id="periodSelect">
                            <option value="7">7 derniers jours</option>
                            <option value="30" selected>30 derniers jours</option>
                            <option value="90">3 derniers mois</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="commandesChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top Plats Chart -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header" style="color: #fff">
                        Top 5 Plats
                    </div>
                    <div class="card-body">
                        <canvas id="topPlatsChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row g-4 mt-2">
            <!-- Commandes par Statut -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header" style="color: #fff">
                        Commandes par Statut
                    </div>
                    <div class="card-body">
                        <canvas id="statutCommandesChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Alertes Stock -->
            {{--
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span style="color: #fff">Alertes Stock</span>
                        <a href=" route('ingredients.index') " class="btn btn-sm btn-outline-light">Voir tout</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @if(count($lowStock) > 0)
                                @foreach($lowStock as $item)
                                    <div class="list-group-item bg-transparent border-secondary">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span style="color: #fff">{{ $item['nom'] }}</span>
                                            <span class="badge bg-danger">{{ $item['stock'] }}/{{ $item['alerte_stock'] }}</span>
                                        </div>
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-danger"
                                                 style="width: {{ ($item['stock']/$item['alerte_stock'])*100 }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                                    <p class="mt-2 mb-0">Aucune alerte de stock</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span style="color: #fff">Dernières Commandes</span>
                        <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-outline-light">Voir tout</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Plat</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($recentOrders))
                                        @php
                                            $statusClass = [
                                                'en attente' => 'warning',
                                                'en préparation' => 'info',
                                                'en livraison' => 'primary',
                                                'livrée' => 'success',
                                                'annulée' => 'danger'
                                            ];
                                        @endphp

                                        @foreach($recentOrders as $order)
                                            @php
                                                $statut = $order['statut'] ?? 'inconnu';
                                                $colorClass = $statusClass[$statut] ?? 'secondary';
                                            @endphp
                                            <tr>
                                                <td>#{{ $order['id'] }}</td>
                                                <td>{{ $order['prenom'] }} {{ $order['nom'] }}</td>
                                                <td>{{ $order['plat'] }}</td>
                                                <td>{{ $order['quantite'] }}</td>
                                                <td>{{ number_format($order['prix_total'], 0, ',', ' ') }} FCFA</td>
                                                <td>
                                                    <span class="badge bg-{{ $colorClass }}">
                                                        {{ ucfirst($statut) }}
                                                    </span>
                                                </td>
                                                <td>{{ date('d/m/Y H:i', strtotime($order['date_commande'])) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="7" class="text-center py-4 text-muted">Aucune commande récente</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


            --}}

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Mobile sidebar toggle
    /*
    document.getElementById('hamburgerBtn').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('visible');
    });

    // Charts initialization
    document.addEventListener('DOMContentLoaded', function() {
        // Commandes Chart
        const commandesCtx = document.getElementById('commandesChart').getContext('2d');
        const commandesChart = new Chart(commandesCtx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Commandes',
                    data: @json($commandes),
                    backgroundColor: 'rgba(255, 17, 77, 0.2)',
                    borderColor: 'rgba(255, 17, 77, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Top Plats Chart
        const topPlatsCtx = document.getElementById('topPlatsChart').getContext('2d');
        const topPlatsChart = new Chart(topPlatsCtx, {
            type: 'doughnut',
            data: {
                labels: @json($topPlatsLabels),
                datasets: [{
                    data: @json($topPlatsData),
                    backgroundColor: [
                        '#ff114d',
                        '#ff6b35',
                        '#ffbe0b',
                        '#4cc9f0',
                        '#7209b7'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // Commandes par Statut
        const statutCommandesCtx = document.getElementById('statutCommandesChart').getContext('2d');
        const statutCommandesChart = new Chart(statutCommandesCtx, {
            type: 'bar',
            data: {
                labels: ['En attente', 'En préparation', 'En livraison', 'Livrées', 'Annulées'],
                datasets: [{
                    label: 'Commandes',
                    data: [12, 8, 5, 20, 3],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(23, 162, 184, 0.7)',
                        'rgba(13, 110, 253, 0.7)',
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(220, 53, 69, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(23, 162, 184, 1)',
                        'rgba(13, 110, 253, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Period selector
        $('#periodSelect').change(function() {
            alert('Fonctionnalité à implémenter: Chargement des données pour ' + $(this).val() + ' jours');
        });
    });

    // Gestion des notifications
    $(document).ready(function() {
        // Rafraîchir les notifications toutes les 30 secondes
        setInterval(updateNotificationBadge, 30000);

        // Gestion du clic sur une notification
        $('a[data-bs-target="#notifModal"]').on('click', function() {
            const type = $(this).data('type');
            loadNotificationDetails(type);
        });

        // Rafraîchir le badge de notification
        function updateNotificationBadge() {
            $.get('{{ route("notifications.count") }}', function(data) {
                const total = parseInt(data.messages) + parseInt(data.reservations) +
                             parseInt(data.commandes) + parseInt(data.commandepubs);
                $('#notificationBadge').text(total);

                if(total > 0) {
                    $('#notificationBadge').removeClass('d-none');
                } else {
                    $('#notificationBadge').addClass('d-none');
                }
            }, 'json');
        }

        // Charger les détails d'une notification
        function loadNotificationDetails(type) {
            const modalTitle = $('#notifModalTitle');
            const modalBody = $('#notifModalBody');

            // Définir le titre en fonction du type
            let title = '';
            switch(type) {
                case 'messages': title = 'Nouveaux messages'; break;
                case 'reservations': title = 'Nouvelles réservations'; break;
                case 'commandes': title = 'Nouvelles commandes (clients)'; break;
                case 'commandepubs': title = 'Nouvelles commandes publiques'; break;
            }
            modalTitle.text(title);

            // Afficher le spinner pendant le chargement
            modalBody.html(`
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            `);

            // Charger le contenu via AJAX
            $.get(`{{ route("notifications.content") }}?type=${type}`, function(data) {
                let html = '';

                if(data.length === 0) {
                    html = '<div class="text-center py-4 text-muted">Aucun élément à afficher</div>';
                } else {
                    // Construire le HTML en fonction du type
                    switch(type) {
                        case 'messages':
                            data.forEach(msg => {
                                html += `
                                    <div class="mb-3 p-3 border-bottom border-secondary notification-item" data-id="${msg.id}" data-notif-type="message">
                                        <div class="d-flex justify-content-between">
                                            <h6>${msg.name} - ${msg.subject}</h6>
                                            <small class="text-muted">${new Date(msg.date_rec).toLocaleString()}</small>
                                        </div>
                                        <p class="mb-1 small">${msg.message.substring(0, 100)}...</p>
                                        <a href="{{ route('messages.index') }}" class="small">Voir détails</a>
                                    </div>
                                `;
                            });
                            break;

                        case 'reservations':
                            data.forEach(res => {
                                html += `
                                    <div class="mb-3 p-3 border-bottom border-secondary notification-item" data-id="${res.id}" data-notif-type="reservation">
                                        <div class="d-flex justify-content-between">
                                            <h6>${res.nom}</h6>
                                            <small class="text-muted">${new Date(res.date_enregistrement).toLocaleString()}</small>
                                        </div>
                                        <p class="mb-1 small">
                                            ${res.nb_personnes} personne(s) -
                                            ${res.date_reservation} à ${res.heure_reservation}
                                        </p>
                                        <a href="{{ route('reservations.index') }}" class="small">Voir détails</a>
                                    </div>
                                `;
                            });
                            break;

                        case 'commandes':
                            data.forEach(cmd => {
                                html += `
                                    <div class="mb-3 p-3 border-bottom border-secondary notification-item" data-id="${cmd.id}" data-notif-type="commande">
                                        <div class="d-flex justify-content-between">
                                            <h6>${cmd.prenom} ${cmd.nom}</h6>
                                            <small class="text-muted">${new Date(cmd.date_commande).toLocaleString()}</small>
                                        </div>
                                        <p class="mb-1 small">
                                            ${cmd.quantite} x ${cmd.plat_id} -
                                            ${cmd.prix_total} FCFA
                                        </p>
                                        <a href="{{ route('commandes.index') }}" class="small">Voir détails</a>
                                    </div>
                                `;
                            });
                            break;

                        case 'commandepubs':
                            data.forEach(cmd => {
                                html += `
                                    <div class="mb-3 p-3 border-bottom border-secondary notification-item" data-id="${cmd.id}" data-notif-type="commandepub">
                                        <div class="d-flex justify-content-between">
                                            <h6>${cmd.prenom} ${cmd.nom}</h6>
                                            <small class="text-muted">${new Date(cmd.date_commande).toLocaleString()}</small>
                                        </div>
                                        <p class="mb-1 small">
                                            ${cmd.quantite} x ${cmd.plat_id} -
                                            ${cmd.prix_total} FCFA
                                        </p>
                                        <a href="{{ route('commandepubs.index') }}" class="small">Voir détails</a>
                                    </div>
                                `;
                            });
                            break;
                    }
                }

                modalBody.html(html);

                // Marquer comme lu au clic
                $('.notification-item').on('click', function() {
                    const id = $(this).data('id');
                    const notifType = $(this).data('notif-type');

                    $.post('{{ route("notifications.markAsRead") }}', {
                        type: notifType,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    }, function(response) {
                        if(response.success) {
                            updateNotificationBadge();
                        }
                    }, 'json');
                });
            }, 'json');
        }
    });*/
</script>
<script>
    /*
    // Gestion complète de la sidebar et autres fonctionnalités
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Gestion de la position de la sidebar
        const sidebar = document.getElementById('sidebar');
        const savedScroll = sessionStorage.getItem('sidebarScroll');
        if (savedScroll) {
            sidebar.scrollTop = savedScroll;
            sessionStorage.removeItem('sidebarScroll');
        }

        // Sauvegarde position avant actions
        const saveScroll = () => sessionStorage.setItem('sidebarScroll', sidebar.scrollTop);
        document.querySelectorAll('form, a[href*="dashboard"]').forEach(el => {
            el.addEventListener('submit', saveScroll);
            el.addEventListener('click', saveScroll);
        });

        // 2. Toggle mobile
        document.getElementById('hamburgerBtn').addEventListener('click', () => {
            sidebar.classList.toggle('visible');
        });

        // 3. Initialisation des graphiques (existant)
        const commandesCtx = document.getElementById('commandesChart')?.getContext('2d');
        if (commandesCtx) {
            new Chart(commandesCtx, {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Commandes',
                        data: @json($commandes),
                        backgroundColor: 'rgba(255, 17, 77, 0.2)',
                        borderColor: 'rgba(255, 17, 77, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    });*/
</script>

</body>
</html>
