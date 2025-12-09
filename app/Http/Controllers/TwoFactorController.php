<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    protected $loginController;
    
    // 🔥 Injection de dépendance pour accéder au LoginController
    public function __construct(LoginController $loginController)
    {
        $this->loginController = $loginController;
    }
    
    public function showVerificationForm()
    {
        // Vérifier si on a un user_id en session
        if (!session('2fa_user_id')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Session expirée. Veuillez vous reconnecter.'
            ]);
        }
        
        return view('auth.2fa-verify');
    }
    
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required']);
    
    $userId = $request->session()->get('2fa_user_id');
    $user = User::find($userId);
    
    if (!$user) {
        return redirect()->route('login');
    }
    
    $google2fa = new Google2FA();
    
    if ($google2fa->verifyKey($user->google2fa_secret, $request->code)) {
        Auth::login($user); // Ré-authentifier l'utilisateur
        $request->session()->put('2fa_verified', true);
        $request->session()->forget('2fa_user_id');
        
        return redirect()->intended('/home');
    }
    
    return back()->withErrors(['code' => 'Code invalide']);
    }
    
    // Méthode alternative sans injection de dépendance
    public function verifyAlternative(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);
        
        $userId = $request->session()->get('2fa_user_id');
        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login')->withErrors([
                'email' => 'Session expirée. Veuillez vous reconnecter.'
            ]);
        }
        
        $google2fa = new Google2FA();
        
        if ($google2fa->verifyKey($user->google2fa_secret, $request->code, 2)) {
            // 🔥 Connexion manuelle sans passer par LoginController
            Auth::login($user, $request->session()->get('2fa_remember', false));
            
            $request->session()->regenerate();
            $request->session()->put('2fa_verified', true);
            
            $request->session()->forget('2fa_user_id');
            $request->session()->forget('2fa_remember');
            
            // Redirection basée sur le rôle
            if ($user->isAdmin()) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }
        
        return back()->withErrors([
            'code' => 'Code invalide. Veuillez réessayer.'
        ]);
    }
    
    // Méthode pour réenvoyer un code (optionnel)
    public function resend()
    {
        return back()->with('info', 
            'Veuillez utiliser le code actuel dans Google Authenticator. ' .
            'Les codes se renouvellent automatiquement toutes les 30 secondes.'
        );
    }
}