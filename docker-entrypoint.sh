#!/bin/bash
set -e

# Ensure storage/cache permissions
chmod -R 775 storage bootstrap/cache || true

# Laravel optimizations
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run migrations
php artisan migrate --force || true

# Start the app on Railway's provided port, bound to all interfaces
php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
