<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Vérifier le rôle (libellé)
        if ($request->user()->roleinfo->libelle !== "Administrateur") {
            return redirect('/');
        }

        return $next($request);
    }
}
