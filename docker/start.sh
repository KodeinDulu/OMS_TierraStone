#!/bin/bash

# Start PHP-FPM in background
php-fpm -D

# Run migrations & seed
php artisan migrate:fresh --seed

# create storage link inside container
php artisan storage:link --force

# Start nginx in foreground
nginx -g "daemon off;"
