FROM php:8.0-apache

RUN apt-get update && apt-get install -y git

WORKDIR /var/www/html/

COPY /src/ /var/www/html/
COPY /.git/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
