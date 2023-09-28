FROM php:8.1.23-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql zip exif pcntl

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y npm
RUN apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install application dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN npm install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and start PHP-FPM
EXPOSE 80
CMD php artisan migrate && php artisan serve --host=0.0.0.0 --port=80