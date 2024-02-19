FROM php:8.2-fpm
ARG user
ARG uid

# Cài đặt các dependencies cần thiết
RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        zlib1g-dev \
        libzip-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Cài đặt các extension PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo người dùng và cấu hình Composer
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www
USER $user
