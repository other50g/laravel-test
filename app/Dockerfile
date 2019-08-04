FROM php:7.2-fpm

MAINTAINER s-sonoda


RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev \
    git vim unzip \
    && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug

ADD ./conf/php.ini /usr/local/etc/php/
ADD ./conf/xdebug.ini /usr/local/etc/php/conf.d/

WORKDIR /app