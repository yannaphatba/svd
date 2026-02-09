FROM php:8.3-fpm-alpine

# Install Nginx และ Dependencies
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    nginx
    
# Install PDO MySQL
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql gd zip bcmath

# 1. สร้างโฟลเดอร์สำหรับโปรเจกต์ (sdv)
RUN mkdir -p /var/www/html/sdv

# 2. ตั้งค่าพื้นที่ทำงานหลัก
WORKDIR /var/www/html/sdv

# 3. ก๊อปปี้ไฟล์ทั้งหมดจากหน้าแรกของ Repo เข้าไปใน sdv
COPY . .

# 4. ใช้ไฟล์คอนฟิกจาก docker/nginx/conf.d/app.conf ไปทับค่าเริ่มต้นของ Nginx
# (แก้ปัญหาไฟล์ซ้ำ โดยเจาะจงใช้ไฟล์ที่ริวเพิ่งแก้ล่าสุด)
COPY nginx/default.conf /etc/nginx/http.d/default.conf

# 5. รัน Composer เพื่อติดตั้ง Dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 6. จัดการสิทธิ์การเข้าถึงไฟล์ (Permissions)
RUN chown -R www-data:www-data /var/www/html/sdv

# 7. สคริปต์สำหรับเริ่มต้นระบบ (PHP และ Nginx)
RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]