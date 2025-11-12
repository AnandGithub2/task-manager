# 1️⃣ Official PHP with Apache
FROM php:8.2-apache

# 2️⃣ Enable Apache rewrite module (Laravel ke routes ke liye)
RUN a2enmod rewrite

# 3️⃣ Install PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip && \
    docker-php-ext-install pdo pdo_mysql gd

# 4️⃣ Set working directory
WORKDIR /var/www/html

# 5️⃣ Copy project files into container
COPY . .

# 6️⃣ Install Composer (Laravel dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7️⃣ Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# 8️⃣ Set folder permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9️⃣ Expose port 80 (default web port)
EXPOSE 80

# 🔟 Start Apache web server
CMD ["apache2-foreground"]
