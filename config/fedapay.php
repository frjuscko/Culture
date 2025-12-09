<?php
// config/fedapay.php

return [
    /*
    |--------------------------------------------------------------------------
    | FedaPay Environment
    |--------------------------------------------------------------------------
    |
    | Spécifiez l'environnement FedaPay à utiliser.
    | Options: "sandbox", "live"
    |
    */
    'environment' => env('FEDAPAY_ENVIRONMENT', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | FedaPay API Key
    |--------------------------------------------------------------------------
    |
    | Votre clé API secrète FedaPay.
    | Obtenez-la sur: https://dashboard.fedapay.com/settings/api-keys
    |
    */
    'api_key' => env('FEDAPAY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | FedaPay Token
    |--------------------------------------------------------------------------
    |
    | Votre token public pour les transactions.
    | Obtenez-le sur: https://dashboard.fedapay.com/settings/tokens
    |
    */
    'token' => env('FEDAPAY_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | FedaPay Webhook Secret
    |--------------------------------------------------------------------------
    |
    | Secret pour vérifier les webhooks FedaPay.
    | Configurez-le dans: https://dashboard.fedapay.com/settings/webhooks
    |
    */
    'webhook_secret' => env('FEDAPAY_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | URLs de Callback
    |--------------------------------------------------------------------------
    */
    'callback_url' => env('APP_URL') . '/payment/callback',
    'cancel_url' => env('APP_URL') . '/payment/cancel',
    'success_url' => env('APP_URL') . '/payment/success',
];