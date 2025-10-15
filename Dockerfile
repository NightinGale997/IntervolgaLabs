FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY fertilizers_silex/composer.json fertilizers_silex/composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

COPY fertilizers_silex/ .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80