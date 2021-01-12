# docker build -t game2 .
# docker run -dit -v "/mnt/d/Users/timakov/PhpstormProjects/game2:/var/www/html/" -d --name game2c -p 8080:80 game2

FROM php:8.0-apache

WORKDIR /var/www/html

COPY php.ini /etc/php/8.0/php.ini
COPY apache2.conf /etc/apache2/apache2.conf

RUN a2enmod rewrite
