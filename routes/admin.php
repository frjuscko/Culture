<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ContenusController;
use Illuminate\Support\Facades\Route;


// Routes protégés
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/utilisateurs', [UtilisateursController::class, 'index'])->name('utilisateurs');
    Route::get('/langues', [LanguesController::class, 'index'])->name('langues');
    Route::get('/regions', [RegionsController::class, 'index'])->name('regions');
    Route::post('/utilisateurs/role', [UtilisateursController::class, 'storeRole'])->name('role.store');
    Route::post('/langues/langueadd', [LanguesController::class, 'addlangue'])->name('langue.store');
    Route::post('/regions/regionadd', [RegionsController::class, 'addregion'])->name('region.store');

    Route::post('/langues', [LanguesController::class, 'supprimer'])->name('lang.del');
    Route::post('/regions', [RegionsController::class, 'supprimer'])->name('reg.del');
});

