#--------------------------------------------------------------------------
# PHP 8.0 With Apache
#-------------------------------------------------------------------------- 
FROM php:8.0-apache

#--------------------------------------------------------------------------
# Label - ZN Framework
#-------------------------------------------------------------------------- 
LABEL maintainer="robot@znframework.com"

#--------------------------------------------------------------------------
# MySQLi Installation
#-------------------------------------------------------------------------- 
RUN docker-php-ext-install mysqli

#--------------------------------------------------------------------------
# SQLServer Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y gnupg2
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update
RUN ACCEPT_EULA=Y apt-get install -y --allow-unauthenticated msodbcsql17
RUN apt-get install -y --allow-unauthenticated unixodbc-dev
RUN apt-get install -y --allow-unauthenticated libgssapi-krb5-2
RUN pecl install sqlsrv
RUN printf "; priority=20\nextension=sqlsrv.so\n" > /usr/local/etc/php/conf.d/sqlsrv.ini

#--------------------------------------------------------------------------
# Posgtres Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y libpq-dev 
RUN docker-php-ext-install pgsql

#--------------------------------------------------------------------------
# Redis Installation
#-------------------------------------------------------------------------- 
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

#--------------------------------------------------------------------------
# Memcached Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y libz-dev libmemcached-dev && \
    pecl install memcached && docker-php-ext-enable memcached

#--------------------------------------------------------------------------
# APC/U Installation
#-------------------------------------------------------------------------- 
RUN pecl install apcu && docker-php-ext-enable apcu

#--------------------------------------------------------------------------
# OPCache Installation
#-------------------------------------------------------------------------- 
RUN docker-php-ext-install opcache && docker-php-ext-enable opcache  

#--------------------------------------------------------------------------
# ZIP Installation
#-------------------------------------------------------------------------- 
RUN apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install zip

#--------------------------------------------------------------------------
# GD Installation
#-------------------------------------------------------------------------- 
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

#--------------------------------------------------------------------------
# Composer Installation
#-------------------------------------------------------------------------- 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#--------------------------------------------------------------------------
# Apache Rewrite Mode On
#-------------------------------------------------------------------------- 
RUN a2enmod rewrite

#--------------------------------------------------------------------------
# Document Root
#--------------------------------------------------------------------------
WORKDIR /var/www/html