<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MessageController;

// Page de bienvenue
Route::get('/welcome', function () {
    return view('welcome');
});

// Routes protégées par l’authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Gestion du contenu administratif
    Route::resource('menus', MenuController::class);
    Route::resource('plats', PlatController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('livreurs', LivreurController::class);
    Route::resource('reservations', ReservationController::class);
});

// Routes liées au profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Pages publiques
Route::get('/', [HomesController::class, 'index']);
Route::get('/index', fn () => view('index'));

// Formulaires publics
Route::post('/commande', [CommandeController::class, 'store'])->name('commande.submit');
Route::post('/commande-publique', [CommandeController::class, 'storePublic'])->name('commandes.storePublic');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.submit');
