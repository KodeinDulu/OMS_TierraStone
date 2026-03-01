#!/bin/bash

# Start PHP-FPM in background
php-fpm -D

# Run migrations & seed
php artisan migrate:fresh --seed

# Start nginx in foreground
nginx -g "daemon off;"
