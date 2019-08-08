FROM php:7.2-fpm

MAINTAINER s-sonoda


RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev \
    git vim unzip \
    && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug

# SQLServer Driver
RUN apt-get install -my wget gnupg
RUN curl -O -fsSL https://packages.microsoft.com/keys/microsoft.asc
RUN apt-key add microsoft.asc
RUN curl https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update
ENV ACCEPT_EULA=Y
RUN apt-get install -y msodbcsql17
RUN apt-get install -y mssql-tools
RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bash_profile
RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
RUN apt-get install -y unixodbc-dev
RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv

# Node.js
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y npm

ADD ./conf/php.ini /usr/local/etc/php/
ADD ./conf/xdebug.ini /usr/local/etc/php/conf.d/
ADD ./conf/20-sqlsrv.ini /usr/local/etc/php/conf.d/
ADD ./conf/30-pdo_sqlsrv.ini /usr/local/etc/php/conf.d/

WORKDIR /app
