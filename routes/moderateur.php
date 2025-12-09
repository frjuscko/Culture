<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ContenusController;
use Illuminate\Support\Facades\Route;


// Routes protégés
Route::middleware(['auth'])->group(function () {
    Route::get('/moderateur', [UserController::class, 'index'])->name('dashboardMod');
    Route::get('lescontenus', [ContenusController::class, 'nonVal'])->name('lescontenus');
    Route::post('/contenus/contenuval', [ContenusController::class, 'valider'])->name('contenu.val');
});

