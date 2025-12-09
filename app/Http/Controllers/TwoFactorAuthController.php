<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        return view('2fa.challenge');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required']);

        $google2fa = new Google2FA();

        $user = User::find(session('2fa:user:id'));

        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->code);

        if ($valid) {
            session()->forget('2fa:user:id');
            Auth::login($user);
            return redirect('/dashboard');
        }

        return back()->withErrors(['code' => 'Code incorrect']);
    }

public function enable2FA(Request $request)
{
    $google2fa = new Google2FA();

    // Génère la clé secrète
    $secret = $google2fa->generateSecretKey();

    // Sauvegarder la clé pour l'utilisateur
    $request->user()->update([
        'two_factor_secret' => $secret,
        'two_factor_enabled' => true,
    ]);

    // Générer les données pour QR Code
    $qrCodeUrl = $google2fa->getQRCodeUrl(
        'NomDuSite',            // nom de ton site
        $request->user()->email,
        $secret
    );

    return view('2fa.enable', [
        'qrCodeUrl' => $qrCodeUrl,
        'secret' => $secret
    ]);
}

}