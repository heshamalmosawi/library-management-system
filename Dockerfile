FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip unzip \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# installing composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# setting permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

# run migrations then start the server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0
