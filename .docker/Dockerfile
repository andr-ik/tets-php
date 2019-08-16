FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql

#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug
#RUN echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#    echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#    echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini
