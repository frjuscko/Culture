#!/usr/bin/env bash

# Installer les dépendances PHP
composer install --no-dev --optimize-autoloader

# Optimiser Laravel pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations de base de données
php artisan migrate --force