FROM php:7.2-apache

MAINTAINER ZN Framework <robot@znframework.com>

RUN docker-php-ext-install mysqli   && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install opcache  && \
    docker-php-ext-enable opcache    
    
RUN a2enmod rewrite

ENV PHPREDIS_VERSION 3.1.4

RUN curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz  \
    && mkdir /tmp/redis \
    && tar -xf /tmp/redis.tar.gz -C /tmp/redis \
    && rm /tmp/redis.tar.gz \
    && ( \
    cd /tmp/redis/phpredis-$PHPREDIS_VERSION \
    && phpize \
    && ./configure \
    && make -j$(nproc) \
    && make install \
    ) \
    && rm -r /tmp/redis \
    && docker-php-ext-enable redis

RUN chmod -R 777 /var/www/html

# Create app directory
WORKDIR /var/www/html