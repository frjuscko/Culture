<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// app/Http/Middleware/CheckTwoFactor.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTwoFactor
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }
        
        $user = Auth::user();
        
        // Si l'utilisateur a activé la 2FA mais n'est pas encore vérifié
        if ($user->google2fa_enabled && !session('2fa_verified')) {
            // Si nous ne sommes pas déjà sur la page de vérification
            if (!$request->is('2fa*')) {
                return redirect()->route('2fa.verify.form');
            }
        }
        
        return $next($request);
    }
}