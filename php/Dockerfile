FROM php:8.3-fpm


RUN apt-get update && apt-get install -y  \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libmemcached-dev \
    default-mysql-client \
    locales \
    git \
    unzip


RUN docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure mysqli \
    && docker-php-ext-install mysqli \
    && docker-php-ext-configure gettext \
    && docker-php-ext-install gettext \
    && docker-php-ext-configure sockets \
    && docker-php-ext-install sockets \
    && docker-php-ext-configure pdo_mysql \
    && docker-php-ext-install pdo_mysql
#    && docker-php-ext-configure ldap \
#    && docker-php-ext-install ldap \
#    && docker-php-ext-configure gd \
#    && docker-php-ext-install gd


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&  \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" &&  \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

RUN composer global require laravel/installer








