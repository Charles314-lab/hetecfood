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


<h1>Bienvenue sur mon site</h1>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
