# ---------- Composer stage ----------
FROM composer:2 AS composer

# ---------- App stage ----------
FROM php:8.2-apache

# Installer Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Extensions PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

RUN a2enmod rewrite

# Installer Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Apache config
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# ✅ COPIER LE PROJET AVANT
COPY . .

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

ENV PORT=10000
CMD php artisan migrate --force && php artisan storage:link && apache2-foreground