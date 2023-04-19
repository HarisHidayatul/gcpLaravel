FROM php:8.0.11-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app
COPY composer.json .
COPY . .
RUN cp .env.example .env

ENV DB_HOST 34.128.93.116
ENV DB_DATABASE testDatabase
ENV DB_USERNAME root

RUN composer install --no-interaction --no-dev --prefer-dist

RUN php artisan key:generate

CMD php artisan serve --host=0.0.0.0 --port 80