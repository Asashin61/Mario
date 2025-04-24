<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
//use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;

// Routes accessibles sans authentification
// Route::get('/login', function () {
//      return view('auth.login'); // Assure-toi que la page login existe
// })->name('login');

//require __DIR__.'/auth.php';

// Routes protégées par auth
//Route::middleware(['auth'])->group(function () {
    // Routes pour les films
    Route::get('/films', [FilmController::class, 'index'])->name('films.index');
    Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('/films', [FilmController::class, 'store'])->name('films.store');
    Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
    Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
    Route::post('/toad/film/add', [FilmController::class, 'store'])->name('films.store');
    Route::get('/film/search', [FilmController::class, 'search'])->name('films.search');

    // Routes pour l'inventaire
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::delete('/inventory/{inventoryId}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/toad/inventory/add', [InventoryController::class, 'store'])->name('inventory.store');


    // Routes liées au profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return view('login_staff');
    });
    Route::post('/login_staff', [LoginController::class, 'login'])->name('login_staff');

    // Route de déconnexion
    //Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
//});

//require __DIR__.'/auth.php';
