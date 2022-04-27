FROM php:8.0-apache

ENV APP_ENV=dev
ENV APP_DEBUG=1
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN a2enmod rewrite
 
RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip nano \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && usermod -u 1000 www-data

COPY ./apache.conf /etc/apache2/sites-enabled/000-default.conf 
COPY ./custom.ini /usr/local/etc/php/conf.d/custom.ini

COPY . /var/www/html

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

RUN chown -R www-data:www-data /var/www/html
USER www-data

