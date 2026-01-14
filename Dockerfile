FROM php:8.2-apache

# Dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

RUN a2enmod rewrite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data storage bootstrap/cache

ENV PORT=10000
EXPOSE 10000

CMD ["apache2-foreground"]
