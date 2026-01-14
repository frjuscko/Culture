FROM composer:2 AS composer
FROM php:8.2-apache

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

RUN a2enmod rewrite

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

# IMPORTANT : Créer les dossiers storage nécessaires
RUN mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs

# Créer le lien symbolique storage -> storage/app/public
RUN php artisan storage:link

# Optimisation Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permissions sur tous les dossiers nécessaires
RUN chown -R www-data:www-data storage bootstrap/cache public

ENV PORT=80
CMD apache2-foreground