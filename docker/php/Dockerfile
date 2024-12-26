FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install vim
RUN apt-get install -y vim

# Set the working directory
WORKDIR /var/www/backend

RUN echo 'alias pa="php artisan"' >> ~/.bashrc && \
    echo 'alias pat="php artisan test"' >> /root/.bashrc && \
    echo 'alias par="php artisan route:list"' >> /root/.bashrc && \
    echo 'alias p="php"' >> /root/.bashrc && \
    echo 'alias c="clear"' >> /root/.bashrc && \
    echo 'alias cc="php artisan cache:clear && php artisan route:clear && php artisan config:clear && php artisan view:clear && php artisan clear-compiled"' >> /root/.bashrc

