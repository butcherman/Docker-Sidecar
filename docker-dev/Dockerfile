FROM php:8.5-cli

# Create the appuser and appgroup
RUN addgroup --gid 1024 appgroup
RUN adduser --disabled-password --gecos "" --force-badname --ingroup appgroup appuser
RUN usermod -a -G www-data appuser

# Add the docker-php-extension-installer script
ADD --chmod=0755 \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    /usr/local/bin/

# Install dependency packages
RUN apt update && apt install -yq \
    curl \
    nano \
    yq \
    zip

# Install PHP Extensions
RUN install-php-extensions \
    bcmath \
    exif \
    fileinfo \
    gd \
    gmp \
    intl \
    pcntl \
    zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Overwrite the Production php.ini file with the dev one
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install xDebug to allow PHPUnit Testing
RUN install-php-extensions xdebug

# Build Healthcheck
# HEALTHCHECK --interval=30s --timeout=10s --start-period=30s --retries=3 \
#     CMD php artisan health:check

# Change the owner of the /var/html folder to allow tbuser to write to it
RUN chown appuser:www-data -R /var/www

# Finalize Image
USER appuser
WORKDIR /var/www/html
