#!/bin/sh
set -x

# Start PHP-FPM in background
php-fpm -D

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link --force

# Write nginx config with correct PORT
cat > /etc/nginx/http.d/default.conf << EOF
server {
    listen ${PORT};
    root /var/www/public;
    index index.php;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF

# Start nginx in foreground
nginx -g "daemon off;"