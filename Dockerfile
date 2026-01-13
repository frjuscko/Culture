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

# Copier la config Apache custom
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# IMPORTANT : Render fournit PORT dynamiquement
ENV PORT=10000

CMD apache2-foreground
