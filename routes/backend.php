<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/profil/{user}', [ProfilController::class, 'show'])->name('profil.show');

// Routes d'édition du profil (authentifiées)
Route::middleware(['auth'])->group(function () {
    Route::get('editerprofil', [ProfilController::class, 'edit'])->name('profiledit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/photo/delete', [ProfilController::class, 'deletePhoto'])->name('profil.photo.delete');
});


require __DIR__.'/admin.php';