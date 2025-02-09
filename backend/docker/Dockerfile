FROM php:7.4-apache

# install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip

# enable apache mod_rewrite \
RUN a2enmod rewrite

# copy php configuration
COPY docker/php.ini /usr/local/etc/php/

# set working directories
WORKDIR /var/www/html

# copy application files
COPY public /var/www/html
COPY src /var/www/html/src

#expose port 80
EXPOSE 80
