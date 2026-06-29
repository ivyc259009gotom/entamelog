FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update \
    && apt-get install -y \
        gcc \
        make \
        git \
        unzip \
        vim \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libpq-dev \
        curl \
        gnupg \
        openssl \
    && docker-php-ext-install pdo_mysql mysqli \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*