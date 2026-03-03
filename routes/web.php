<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PlatsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

   
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'loginPage'])->name('login.page');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'registerPage'])->name('register.page');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [PageController::class, 'home'])->name('root');
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/dashboard', [PlatsController::class, 'dashboard'])->name('dashboard');

    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/panier/add/{plat}', [CommandeController::class, 'addToCart'])->name('panier.add');
    Route::post('/panier/update/{plat}', [CommandeController::class, 'updateCart'])->name('panier.update');
    Route::post('/panier/remove/{plat}', [CommandeController::class, 'removeFromCart'])->name('panier.remove');
    Route::post('/panier/clear', [CommandeController::class, 'clearCart'])->name('panier.clear');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::post('/commandes/{commande}/valider', [CommandeController::class, 'validateCommande'])->name('commandes.valider');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');

    Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('factures.show');

    Route::get('/plats/create', [PlatsController::class, 'create'])->name('plats.create');
    Route::post('/plats', [PlatsController::class, 'store'])->name('plats.store');
    Route::post('/plats/{plat}/delete', [PlatsController::class, 'destroy'])->name('plats.destroy');
});
