<?php

use App\Http\Controllers\ContenuController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AbonnementController;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Route;

// Routes authentifiées pour commenter
Route::middleware(['auth'])->group(function () {
    Route::post('/contenu/{id}/commenter', [ContenuController::class, 'commenter'])->name('contenu.commenter');
});

// Routes profil
Route::get('/profil/{user}', [ProfilController::class, 'show'])->name('profil.show');

// Routes d'édition du profil (authentifiées)
Route::middleware(['auth'])->group(function () {
    Route::get('editerprofil', [ProfilController::class, 'edit'])->name('profiledit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/photo/delete', [ProfilController::class, 'deletePhoto'])->name('profil.photo.delete');

    Route::get('/subscribe', [AbonnementController::class, 'index'])->name('subscribe');
    Route::get('/subscription/pay', [AbonnementController::class, 'pay'])->name('subscription.pay');
Route::get('/payment/callback', [AbonnementController::class, 'callback'])->name('payment.callback');


});


require  __DIR__.'/admin.php';
require  __DIR__.'/contributeur.php';
require  __DIR__.'/moderateur.php';