FROM php:8.4-apache

# Install PHP MySQL extension
RUN docker-php-ext-install mysqli

# Copy app files to Apache web root
COPY app/ /var/www/html/

# Generate .env file from environment variables at runtime
CMD ["/bin/sh", "-c", "printf 'DB_HOST=%s\nDB_USER=%s\nDB_PASSWORD=%s\nDB_NAME=%s\n' \"$DB_HOST\" \"$DB_USER\" \"$DB_PASSWORD\" \"$DB_NAME\" > /var/www/html/.env && apache2-foreground"]