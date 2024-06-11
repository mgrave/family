# Use the PHP 7.2 base image
FROM php:7.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    libzip-dev \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql tokenizer pcntl gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for Laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy custom entrypoint script
#COPY entrypoint.sh /usr/local/bin/entrypoint.sh
#RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy composer files
COPY composer.json /var/www/

RUN rm composer.lock

# Run composer install
RUN composer install --no-interaction --optimize-autoloader

# Install nvm
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash

# Install Node.js LTS version using nvm
RUN /bin/bash -c "source /root/.bashrc && nvm install --lts"

# Install npm
RUN /bin/bash -c "source /root/.bashrc && npm install npm@latest -g"


# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Use custom entrypoint script
#ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
