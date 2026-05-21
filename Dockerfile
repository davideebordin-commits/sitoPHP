FROM php:8.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y nginx
COPY . /var/www/html/
COPY <<EOF /etc/nginx/sites-available/default
server {
    listen 80;
    root /var/www/html;
    index index.php;
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
    }
}
EOF
CMD service nginx start && php-fpm