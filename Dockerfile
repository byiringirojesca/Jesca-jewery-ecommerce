# =========================
# Build Frontend (Vite)
# =========================
FROM node:20-alpine AS node_builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

# Build frontend (safe fallback for CSS issues)
RUN npm run build -- --mode production || npx vite build --cssMinify=false


# =========================
# Laravel Production Image
# =========================
FROM php:8.4-cli-alpine

WORKDIR /var/www

# =========================
# System dependencies
# =========================
RUN apk add --no-cache \
    bash \
    curl \
    zip \
    unzip \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev

# =========================
# PHP extensions
# =========================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd

# =========================
# Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Copy app
# =========================
COPY . .

# =========================
# Copy built frontend
# =========================
COPY --from=node_builder /app/public/build /var/www/public/build

# =========================
# Install dependencies
# =========================
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

# =========================
# Ensure storage structure exists, then set permissions
# =========================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# =========================
# Railway runtime server
# =========================
EXPOSE 8080

COPY docker-entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]