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
    unzip \
    librabbitmq-dev \
    libssl-dev \
    libtool \
    autoconf \
    pkg-config \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl

RUN docker-php-source extract \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && docker-php-source delete

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer self-update

RUN git config --global --add safe.directory /var/www/htm

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor /var/www/html/public

EXPOSE 9000

CMD ["php-fpm"]