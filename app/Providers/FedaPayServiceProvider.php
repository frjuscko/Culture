<?php
// app/Providers/FedaPayServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FedaPay\FedaPay;

class FedaPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publier la configuration
        $this->publishes([
            __DIR__.'/../../config/fedapay.php' => config_path('fedapay.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge la configuration
        $this->mergeConfigFrom(
            __DIR__.'/../../config/fedapay.php', 'fedapay'
        );

        // Initialiser FedaPay
        $this->app->singleton('fedapay', function ($app) {
            // Vérifier si les clés sont configurées
            $apiKey = config('fedapay.api_key');
            $environment = config('fedapay.environment');
            
            if (!$apiKey) {
                throw new \Exception('FedaPay API Key non configurée. Vérifiez votre fichier .env');
            }
            
            // Initialiser FedaPay
            FedaPay::setApiKey($apiKey);
            FedaPay::setEnvironment($environment);
            
            // Optionnel: configurer le token
            if ($token = config('fedapay.token')) {
                FedaPay::setToken($token);
            }
            
            return FedaPay::class;
        });
    }
}