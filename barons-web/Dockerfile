FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Remove any stale caches copied from the local repository
RUN rm -f bootstrap/cache/*.php

RUN composer install --no-dev --no-scripts --optimize-autoloader

EXPOSE 10000

# Clear & rebuild config cache at runtime using Render's injected env vars, then start the server
CMD sh -c "php artisan config:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"