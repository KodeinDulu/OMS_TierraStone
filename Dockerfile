FROM php:8.2-fpm-alpine

# Install system dependencies (alpine uses apk, not apt)
RUN apk add --no-cache \
    git curl zip unzip nginx nodejs npm \
    icu-dev libzip-dev libpng-dev oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql mbstring bcmath gd zip intl pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80
CMD sh -c "php-fpm -D && php artisan migrate:fresh --seed && nginx -g 'daemon off;'"
