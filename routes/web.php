<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route principale pour afficher la liste des films
Route::get('/films', [FilmController::class, 'index'])->name('films.index');

// Rediriger vers la liste des films par défaut
Route::get('/', function () {
    return redirect()->route('films.index'); // Redirige vers la liste des films
})->name('home');

// Routes pour les films
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
Route::post('/toad/film/add', [FilmController::class, 'store'])->name('films.store');

// Route de recherche pour les films
Route::get('/film/search', [FilmController::class, 'search'])->name('films.search');

// Routes pour l'inventaire
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Routes liées au profil de l'utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route de déconnexion
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
