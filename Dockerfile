FROM php:8.1-fpm-alpine

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql
