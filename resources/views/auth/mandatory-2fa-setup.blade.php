{{-- resources/views/auth/mandatory-2fa-setup.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration 2FA Obligatoire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .setup-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .qr-code-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .steps {
            margin-bottom: 30px;
        }
        .step {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container setup-container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">🔒 Configuration de la Double Authentification</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Obligatoire :</strong> Pour la sécurité de votre compte, vous devez configurer l'authentification à deux facteurs.
                </div>
                
                <div class="steps">
                    <div class="step">
                        <h5>Étape 1 : Téléchargez Google Authenticator</h5>
                        <p class="text-muted">
                            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">
                                Android
                            </a> | 
                            <a href="https://apps.apple.com/fr/app/google-authenticator/id388497605" target="_blank">
                                iOS
                            </a>
                        </p>
                    </div>
                    
                    <div class="step">
                        <h5>Étape 2 : Scannez le QR Code</h5>
                        <div class="text-center my-4">
                            <div class="qr-code-container d-inline-block">
                                <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid">
                            </div>
                        </div>
                        <p class="text-muted text-center">
                            <small>Ou entrez ce code manuellement : <code>{{ chunk_split($secret, 4, ' ') }}</code></small>
                        </p>
                    </div>
                    
                    <div class="step">
                        <h5>Étape 3 : Entrez le code de vérification</h5>
                        <form method="POST" action="{{ route('2fa.mandatory.complete') }}">
                            @csrf
                            
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label for="code" class="form-label">Code à 6 chiffres</label>
                                <input type="text" 
                                       class="form-control form-control-lg text-center @error('code') is-invalid @enderror" 
                                       id="code" 
                                       name="code" 
                                       required 
                                       autofocus
                                       maxlength="6"
                                       placeholder="000000"
                                       style="letter-spacing: 5px; font-size: 1.5rem;">
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    ✅ Valider et continuer
                                </button>
                                
                                <button type="button" 
                                        class="btn btn-outline-secondary"
                                        onclick="if(confirm('Générer un nouveau QR Code ?')) {
                                            document.getElementById('regenerate-form').submit();
                                        }">
                                    🔄 Régénérer le QR Code
                                </button>
                            </div>
                        </form>
                        
                        <form id="regenerate-form" method="POST" action="{{ route('2fa.mandatory.regenerate') }}">
                            @csrf
                            <input type="hidden" name="action" value="regenerate">
                        </form>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h6>💡 Conseils :</h6>
                    <ul class="text-muted">
                        <li>Gardez une copie de votre code secret en lieu sûr</li>
                        <li>L'application Google Authenticator est gratuite</li>
                        <li>Vous devrez entrer un code à chaque connexion</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>