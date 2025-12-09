<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification en deux étapes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Si tu utilises Bootstrap, active ceci -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 380px;
            border-radius: 12px;
        }
        input {
            font-size: 18px;
            letter-spacing: 3px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card shadow p-4">
    <h4 class="text-center mb-3">Vérification Google Authenticator</h4>

    <p class="text-muted text-center">Veuillez entrer le code à 6 chiffres affiché dans votre application Google Authenticator.</p>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/two-factor-challenge">
        @csrf

        <div class="mb-3">
            <input type="text" name="code" class="form-control form-control-lg"
                   placeholder="000 000" maxlength="6" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Vérifier
        </button>
    </form>
</div>

</body>
</html>
