# ---------------- Base Image ----------------
FROM php:8.2-apache

# ---------------- System Dependencies ----------------
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite

# ---------------- Install Composer ----------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ---------------- Apache ServerName ----------------
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ---------------- Opcache Settings ----------------
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.validate_timestamps=1'; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# ---------------- Set Workdir ----------------
WORKDIR /var/www/html

# ---------------- Copy Project ----------------
COPY . /var/www/html

# ---------------- Install PHP Dependencies (include dev for local) ----------------
RUN composer install --optimize-autoloader --no-interaction --no-scripts

# ---------------- Ensure .env Exists ----------------
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# ---------------- Install Collision (dev helper) ----------------
RUN composer require --dev nunomaduro/collision:^8.8 || true
RUN composer dump-autoload -o

# ---------------- Clear Laravel Caches ----------------
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear || true

# ---------------- Generate Laravel Key ----------------
RUN php artisan key:generate --ansi || true

# ---------------- Fix Permissions ----------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ---------------- Apache Document Root ----------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# ---------------- Expose Port ----------------
EXPOSE 80

# ---------------- Start Apache ----------------
CMD ["apache2-foreground"]
