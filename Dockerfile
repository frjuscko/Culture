# ---------- Composer stage ----------
FROM composer:2 AS composer

# ---------- App stage ----------
FROM php:8.2-apache

# Installer Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Installer extensions PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Activer mod_rewrite
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Apache config (port Render)
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copier uniquement les fichiers Composer (cache Docker)
COPY composer.json composer.lock ./

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copier le reste du projet
COPY . .

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Port dynamique Render
ENV PORT=10000

CMD apache2-foreground
