# Gunakan image resmi PHP 8.3 dengan FPM sebagai dasar
FROM php:8.3-fpm

# Set direktori kerja di dalam container
WORKDIR /var/www/html

# Install dependensi sistem yang dibutuhkan oleh Laravel & Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file proyek yang sudah ada di lokal ke dalam container
COPY . .

# Install dependensi PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Atur izin untuk folder storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port untuk FPM
EXPOSE 9000

# Perintah default untuk menjalankan PHP-FPM
CMD ["php-fpm"]