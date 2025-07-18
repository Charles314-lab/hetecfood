<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;


Route::get('/welcome', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Route pour gérer les menus
    Route::resource('menus', MenuController::class);

    // ✅ Route pour gérer les plats
    Route::resource('plats', PlatController::class);

    // ✅ Route pour gérer les clients
    Route::resource('clients', ClientController::class);

    // ✅ Route pour gérer les commandes
    Route::resource('commandes', CommandeController::class);

    // ✅ Route pour gérer les livreurs
    Route::resource('livreurs', LivreurController::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/index', function () {
    return view('index');
});

Route::get('/',[HomesController::class, 'index']);
Route::post('/commande', [CommandeController::class, 'store'])->name('commande.submit');


