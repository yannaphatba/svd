FROM php:8.3-fpm-alpine
RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip nginx
RUN docker-php-ext-install pdo pdo_mysql gd zip bcmath

WORKDIR /var/www/html

# 1. ก๊อปปี้ทุกอย่างที่อยู่ที่เดียวกับ Dockerfile (รวมถึง composer.json)
COPY . .

# 2. ก๊อปปี้คอนฟิก Nginx (พิกัดตามรูป image_a4dc84.png)
COPY nginx/default.conf /etc/nginx/http.d/default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# --- จุดสำคัญ: เชื่อมรูปภาพ นศ. (Profiles/Vehicles) ---
RUN php artisan storage:link

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]