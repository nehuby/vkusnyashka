FROM php:apache

ARG GID UID

RUN groupadd -g "${GID}" -r laravel \
    && useradd -g laravel -l -r -u "${UID}" laravel \
    && docker-php-ext-install pdo pdo_mysql

USER laravel
