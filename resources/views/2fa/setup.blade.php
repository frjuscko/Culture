<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Activer la double authentification</title>
</head>
<body>

<h2>Activez la double authentification</h2>

<p>Scannez ce QR Code avec Google Authenticator :</p>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $qrCodeUrl }}">

<p>Ou entrez ce code manuellement :</p>
<h3>{{ $secret }}</h3>

<form method="POST" action="/2fa/setup">
    @csrf
    <input type="hidden" name="secret" value="{{ $secret }}">

    <button type="submit">Activer la double authentification</button>
</form>

</body>
</html>
