FROM php:fpm

COPY ./code /usr/src/dst_folder
WORKDIR /usr/src/dst_folder

RUN apt-get update && apt-get install

RUN docker-php-ext-install pdo pdo_mysql