# docker build -t game2 .
# docker run -dit -v "/mnt/d/Users/timakov/PhpstormProjects/game2:/var/www/html/" -d --name game2c -p 80:80 game2

FROM php:8.0-apache

WORKDIR /var/www/html

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY php.ini /etc/php/8.0/php.ini
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
