FROM php:8.2-fpm

WORKDIR /var/www/html
COPY . .

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libicu-dev \
    libonig-dev \
    zlib1g-dev \
    git \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer self-update
RUN composer install

RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

EXPOSE 9000