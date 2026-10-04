FROM php:8.5-cli

WORKDIR /var/www/html

# Install dependency packages
RUN apt update && apt install -yq \
    curl \
    nano

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Overwrite the Production php.ini file with the dev one
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install xDebug to allow PHPUnit Testing
RUN install-php-extensions xdebug

# Copy the .ini file for additional debug configuration
COPY ./php-dev.ini $PHP_INI_DIR/conf.d/php-dev.ini

# Application Files
# COPY ./src /var/www/html

# RUN composer install \
#     --no-dev \
#     --no-interaction \
#     --prefer-dist \
#     --optimize-autoloader

# Laravel writable directories
# RUN chown -R www-data:www-data \
#     storage \
#     bootstrap/cache

# COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
# RUN chmod +x /usr/local/bin/entrypoint.sh

# ENTRYPOINT [ "entrypoint.sh" ]

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]