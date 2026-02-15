FROM php:8.3-fpm-alpine

RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip nginx
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) pdo pdo_mysql gd zip bcmath

WORKDIR /var/www/html/sdv
COPY . .

# ก๊อปคอนฟิก Nginx
COPY nginx/default.conf /etc/nginx/http.d/default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# รัน composer ที่หน้าแรก
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# แก้ไขจุดนี้: มั่นใจว่ามีโฟลเดอร์ storage และสิทธิ์ถูกต้องเพื่อกันปัญหา Page Expired (419)
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/sdv && \
    chmod -R 775 storage bootstrap/cache

RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]