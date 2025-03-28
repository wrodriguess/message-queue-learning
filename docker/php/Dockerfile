FROM php:8.2-alpine3.18

RUN apk update

RUN apk add --update --no-cache rabbitmq rabbitmq-plugins

RUN rabbitmq-plugins enable --offline rabbitmq_management

RUN apk add --update --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    libintl-dev \
    icu-dev \
    postgresql-dev \
    pcre-dev \
    autoconf \
    dpkg-dev \
    dpkg \
    file \
    g++ \
    gcc \
    libc-dev \
    make \
    pkgconf \
    re2c \
    rabbitmq-c-dev \
    rabbitmq-c

RUN pecl install amqp && docker-php-ext-enable amqp

RUN docker-php-ext-install intl pdo pdo_pgsql pdo_mysql

RUN pecl install redis && docker-php-ext-enable redis

RUN apk add --update --no-cache php-xml php-dom

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /code
COPY .. .

RUN composer install --no-scripts --no-autoloader

RUN composer dump-autoload --optimize

EXPOSE 9000

CMD service rabbitmq start && php -S 0.0.0.0:9000 -t /code/public