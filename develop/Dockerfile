FROM node:22.13.0-bookworm-slim as node

FROM php:8.4.2-apache-bookworm

COPY --from=node /usr/local/ /usr/local/
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
  git

RUN docker-php-ext-install pdo_mysql

COPY 000-default.conf /etc/apache2/conf-available/000-default.conf

WORKDIR /var/www/html

RUN a2enconf 000-default

EXPOSE 80
