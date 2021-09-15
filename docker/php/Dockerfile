FROM php:8.0-fpm

VOLUME ["/var/www/html"]

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y apt-utils git libzip-dev libicu-dev libxslt-dev zip
RUN pecl install apcu-5.1.18;
RUN docker-php-ext-install pdo_mysql opcache zip intl xsl
RUN docker-php-ext-enable apcu opcache
COPY opcache.ini /usr/local/etc/php/conf.d/
RUN usermod -u 1000 -d /var/www -s /bin/bash -p secret www-data \
    && groupmod -g 1000 www-data \
    && chown -R www-data:www-data /var/www/

RUN apt-get install -y ca-certificates
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=true" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 80
