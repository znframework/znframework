FROM php:7.2-apache
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

RUN chmod -R 777 /var/www/html

# Create app directory
WORKDIR /var/www/html