FROM php:8.3-fpm-alpine

# ติดตั้ง Extension ที่จำเป็น
RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip nginx
RUN docker-php-ext-install pdo pdo_mysql gd zip bcmath

# 1. ตั้งค่าโฟลเดอร์ทำงานหลักไปที่โฟลเดอร์ src ของโปรเจกต์
WORKDIR /var/www/html/src

# 2. ก๊อปปี้ไฟล์ทั้งหมดเข้าไป (เพื่อให้โครงสร้างในตู้คอนเทนเนอร์ตรงกับที่เราตั้งใน Nginx)
COPY . /var/www/html

# 3. ก๊อปปี้คอนฟิก Nginx (ไฟล์นี้สำคัญมาก ต้องแก้ตามที่ผมบอกก่อนหน้านี้ด้วยนะ)
COPY nginx/default.conf /etc/nginx/http.d/default.conf

# 4. ติดตั้ง Composer และ Dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 5. ตั้งค่า Permissions ให้ถูกต้อง (แก้จากเดิมที่ชี้แค่บางโฟลเดอร์ ให้ครอบคลุมจุดที่ Laravel ต้องเขียนไฟล์)
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/src/storage /var/www/html/src/bootstrap/cache
RUN chmod -R 775 /var/www/html/src/storage /var/www/html/src/bootstrap/cache

# 6. สร้าง Symbolic Link สำหรับเก็บรูปภาพ
RUN php artisan storage:link

# 7. Script สำหรับรันทั้ง PHP-FPM และ Nginx
RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]