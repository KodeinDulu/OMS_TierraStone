#!/bin/sh
set -x

php-fpm -D

php artisan migrate --force
php artisan storage:link --force

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

# Kill any existing nginx
pkill nginx || true

nginx -g "daemon off;" 2>&1
echo "nginx exited: $?"


php artisan db:seed --force