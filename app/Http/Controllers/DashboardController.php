<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur avec sa relation role
        $user = Auth::user()->load(['roleinfo', 'langueinfo', 'regioninfo']);


        return view('dashboard', compact('user'));
    }
}
