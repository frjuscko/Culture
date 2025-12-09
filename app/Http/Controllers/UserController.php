<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Récupérer l'utilisateur avec sa relation role
    public function index()
    {
        // Récupérer l'utilisateur avec sa relation role
        $user = Auth::user()->load(['roleinfo', 'langueinfo', 'regioninfo']);


        return view('contributeur', compact('user'));
    }

}
