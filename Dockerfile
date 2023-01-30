FROM php:8.0-apache as base

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY ./src /var/www/html
