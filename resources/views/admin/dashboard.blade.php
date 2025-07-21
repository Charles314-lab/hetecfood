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
        <div class="btn-group">
            <button class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-sync-alt"></i> Actualiser
            </button>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Cartes de statistiques améliorées -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Clients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clients }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Plats</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $plats }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-utensils fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Commandes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $commandes }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Réservations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reservations }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Messages</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $messages }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-left-teal shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-teal text-uppercase mb-1">
                                    Livreurs disponibles</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $livreurs_dispo }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck fa-2x text-teal"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="#" class="small-box-footer">
                            Voir détails <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section supplémentaire pour les statistiques -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>Statistiques récentes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="info-box bg-gradient-info">
                                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Nouveaux clients</span>
                                        <span class="info-box-number">41,410</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 70%"></div>
                                        </div>
                                        <span class="progress-description">
                                            70% Increase in 30 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-box bg-gradient-success">
                                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Commandes</span>
                                        <span class="info-box-number">1,410</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            50% Increase in 30 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-box bg-gradient-warning">
                                    <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Revenus</span>
                                        <span class="info-box-number">$8,410</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: 80%"></div>
                                        </div>
                                        <span class="progress-description">
                                            80% Increase in 30 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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

        .info-box {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            border-radius: 0.5rem;
            background-color: #fff;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            padding: 0.5rem;
            position: relative;
        }

        .info-box-icon {
            display: block;
            float: left;
            height: 70px;
            width: 70px;
            text-align: center;
            font-size: 1.875rem;
            line-height: 70px;
            background: rgba(0,0,0,0.2);
            border-radius: 0.5rem;
        }

        .info-box-content {
            padding: 5px 10px;
            margin-left: 80px;
        }
    </style>
@stop
