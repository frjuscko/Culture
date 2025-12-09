<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
// routes/web.php


// Routes publiques
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contenu/{id}', [ContenuController::class, 'show'])->name('contenu.show');

// Routes profil
Route::get('/profil/{user}', [ProfilController::class, 'show'])->name('profil.show');
Route::get('/profil/{user}/contenus', [ProfilController::class, 'contenus'])->name('profil.contenus');

// Optionnel : édition du profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
});