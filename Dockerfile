FROM php:fpm

# Set working directory
WORKDIR /var/www/html

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Copy existing application directory
COPY . .

EXPOSE 9000
CMD ["php-fpm"]
