FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

RUN echo 'alias pa="php artisan"' >> ~/.bashrc
RUN echo 'alias p="php"' >> ~/.bashrc
RUN echo 'alias c="clear"' >> ~/.bashrc
RUN echo 'alias cc="php artisan cache:clear&&php artisan route:clear&&php artisan config:clear&&php artisan view:clear&&php artisan clear-compiled"' >> ~/.bashrc
RUN source ~/.bashrc
