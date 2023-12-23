FROM php:8.0-apache

RUN apt-get update && apt-get install -y git

WORKDIR /var/www/html/

COPY . /var/www/html/

COPY php.ini /etc/php/5.6/apache2/php.ini

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80