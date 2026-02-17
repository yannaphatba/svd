FROM php:8.3-fpm-alpine

# ติดตั้ง Library พื้นฐาน
RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip nginx
RUN docker-php-ext-install pdo pdo_mysql gd zip bcmath

# 1. ตั้งหลักที่โฟลเดอร์ src
WORKDIR /var/www/html/src

# 2. ก๊อปปี้ไฟล์จาก src ในเครื่องริว มาลงที่ /var/www/html/src ใน Docker
# (เพื่อให้ .env และ artisan อยู่ถูกที่)
COPY src/ .

# 3. จัดการเรื่อง .env (ถ้าไม่มีบน GitHub ให้ก๊อปจาก example)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# 4. ก๊อปปี้ Config Nginx (ไฟล์นี้อยู่นอก src)
COPY nginx/default.conf /etc/nginx/http.d/default.conf

# 5. ติดตั้ง Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 6. สร้าง "บ้านเปล่า" สำหรับเก็บรูป และตั้งสิทธิ์ให้ Laravel เขียนไฟล์ได้
RUN mkdir -p storage/app/public/Profiles storage/app/public/Vehicles \
    storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/src/storage /var/www/html/src/bootstrap/cache && \
    chmod -R 775 /var/www/html/src/storage /var/www/html/src/bootstrap/cache

# 7. เชื่อมโยงโฟลเดอร์เก็บรูป
RUN php artisan storage:link

# 8. Start Script
RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]