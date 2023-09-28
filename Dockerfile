FROM php:8.2.10-fpm

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    libzip-dev\
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY . .

RUN chmod -R ugo+rw storage

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-progress --no-interaction

CMD ["php-fpm"]
