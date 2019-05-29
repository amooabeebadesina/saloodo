FROM php:7-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client \
     && docker-php-ext-install pdo_mysql \
     && pecl install mcrypt-1.0.2 && docker-php-ext-enable mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

EXPOSE 9000