FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    pkg-config \
    libonig-dev
    
RUN apt-get -y --no-install-recommends install g++ zlib1g-dev
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install mbstring zip exif pcntl

# Copy composer.json
COPY ./composer.json .
COPY ./local.ini /usr/local/etc/php/conf.d/local.ini

# Install composer
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
# set time zone service to bangkok
ENV TZ=Asia/Bangkok  
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Copy existing application directory contents
# Change current user to www
RUN chown -R www-data:www-data /var/www
RUN chmod 777 -R /var/www/cache


USER root

EXPOSE 9000