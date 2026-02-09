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

# ก๊อปคอนฟิก Nginx จากหน้าแรกของ Repo (ตำแหน่งใหม่ที่ริววางไฟล์ไว้)
COPY docker/nginx/conf.d/app.conf /etc/nginx/http.d/default.conf

# สร้างโฟลเดอร์ sdv เพื่อรองรับ URL มหาลัย
RUN mkdir -p /var/www/html/sdv

# ก๊อปปี้ไฟล์ทั้งหมดจากหน้าแรก เข้าไปที่ sdv
WORKDIR /var/www/html/sdv
COPY . .

# รัน Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# จัดการ Permissions
RUN chown -R www-data:www-data /var/www/html/sdv

# สคริปต์รัน Nginx และ PHP-FPM
RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]