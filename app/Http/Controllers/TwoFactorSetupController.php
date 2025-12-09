<?php

// app/Http/Controllers/TwoFactorSetupController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwoFactorSetupController extends Controller
{
    public function showMandatorySetup()
    {
        if (!session('2fa_setup_required')) {
            return redirect('/home');
        }
        
        $userId = session('2fa_user_id');
        $user = User::find($userId);
        
        if (!$user) {
            return redirect('/login');
        }
        
        $qrCodeUrl = $user->getTwoFactorQrCode();
        $secret = $user->google2fa_secret;
        
        return view('auth.mandatory-2fa-setup', compact('qrCodeUrl', 'secret', 'user'));
    }
    
    public function completeSetup(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);
        
        $userId = session('2fa_user_id');
        $user = User::find($userId);
        
        if (!$user) {
            return redirect('/login');
        }
        
        $google2fa = new Google2FA();
        
        // Vérifier le code
        if ($google2fa->verifyKey($user->google2fa_secret, $request->code)) {
            // Connecter l'utilisateur
            Auth::login($user);
            
            // Nettoyer la session
            session()->forget(['2fa_user_id', '2fa_setup_required', '2fa_secret']);
            
            // Rediriger vers la page d'accueil
            return redirect('/home')->with('success', '2FA configurée avec succès !');
        }
        
        return back()->withErrors(['code' => 'Code invalide. Veuillez réessayer.']);
    }
    
    public function skipOrRegenerate(Request $request)
    {
        $action = $request->input('action');
        $userId = session('2fa_user_id');
        $user = User::find($userId);
        
        if ($action === 'regenerate') {
            $user->generateTwoFactorSecret();
            return back()->with('info', 'Nouveau secret généré. Scannez le nouveau QR Code.');
        }
        
        // Forcer la reconnexion si l'utilisateur essaie de sauter
        return redirect('/login')->with('error', 'La configuration 2FA est obligatoire.');
    }
}