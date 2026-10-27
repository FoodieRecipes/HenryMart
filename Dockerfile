FROM php:8.2-apache

# Install PDO MySQL and MySQLi extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copy application files to web root
COPY . /var/www/html/

# Set file permissions for web server
RUN chown -R www-data:www-data /var/www/html

# Expose standard HTTP port
EXPOSE 80

CMD ["apache2-foreground"]
