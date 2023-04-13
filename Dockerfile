FROM php:8.0-apache

COPY / /var/www/html/

COPY php.ini /etc/php/5.6/apache2/php.ini

WORKDIR /

EXPOSE 80