FROM php:8.3-fpm-alpine

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install nginx
RUN apk add --no-cache nginx

# Copy nginx config
COPY nginx/default.conf /etc/nginx/http.d/default.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Start both PHP-FPM and Nginx
RUN echo "#!/bin/sh" > /start.sh && \
    echo "php-fpm -D" >> /start.sh && \
    echo "nginx -g 'daemon off;'" >> /start.sh && \
    chmod +x /start.sh

CMD ["/start.sh"]
