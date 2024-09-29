FROM php:7.1-apache

RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    python2 \
    build-essential \
    python3 \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.2.0 --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g yarn

WORKDIR /var/www

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload

RUN yarn install
RUN yarn prod

COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

CMD ["sh", "-c", "/usr/local/bin/wait-for-it.sh db -- php artisan migrate --force"]

CMD ["apache2-foreground"]
