FROM php:8.2-fpm

# Install library yg dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    build-essential zip unzip curl git \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy source project
COPY . .

# Install Laravel dependency
RUN composer install

# Set permission
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
