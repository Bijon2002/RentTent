#!/bin/sh

# Clear Laravel caches safely
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Generate Laravel key if not set
php artisan key:generate --ansi

# Start Apache
apache2-foreground
