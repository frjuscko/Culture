FROM php:8.2-apache

# Dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd zip pdo pdo_mysql mbstring bcmath exif pcntl

# Activer mod_rewrite
RUN a2enmod rewrite

# Apache → public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Assets Vite
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render injecte $PORT
EXPOSE 80

CMD ["apache2-foreground"]
