FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    icu-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    intl

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
