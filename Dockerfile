FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    git curl zip unzip nginx nodejs npm \
    icu-dev libzip-dev libpng-dev oniguruma-dev \
    libpq-dev gettext

RUN docker-php-ext-install \
    pdo_mysql pdo_pgsql pgsql mbstring bcmath gd zip intl pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN mkdir -p /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/logs \
    /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

RUN composer install --no-dev --optimize-autoloader --verbose

RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD sh -c "php artisan storage:link --force && \
    php-fpm -D && \
    php artisan migrate --force && \
    envsubst '\$PORT' < /etc/nginx/http.d/default.conf > /tmp/nginx.conf && \
    nginx -c /tmp/nginx.conf -g 'daemon off;'"