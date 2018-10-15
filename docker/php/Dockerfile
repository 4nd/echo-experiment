FROM php:7.2-fpm-alpine

RUN apk --no-cache add curl git bash zsh nano openssh zlib-dev pcre-dev ${PHPIZE_DEPS} \
  && docker-php-ext-install opcache zip pdo pdo_mysql \
  && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN printf '[PHP]\ndate.timezone = "Europe/London"\n' > /usr/local/etc/php/conf.d/tzone.ini

RUN pecl install apcu
RUN docker-php-ext-enable apcu

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.max_nesting_level = 250" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ENV TERM xterm
WORKDIR /var/www/html