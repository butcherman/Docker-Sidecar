################################################################################
#                                                                              #
#             Tech Bench build for dev Tech Bench Application                  #
#                                                                              #
################################################################################

FROM mysql:9.4 AS mysql
FROM php:8.5-fpm

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
    nodejs \
    npm \
    openssl \
    unzip \
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
    pdo_mysql \
    zip

# Bring NodeJS and NPM up to the latest version
RUN npm install -g n
RUN n lts
RUN npm install -g npm@12.0.1


# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Overwrite the Production php.ini file with the dev one
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install xDebug to allow PHPUnit Testing
RUN install-php-extensions xdebug

# Copy the .ini file for additional debug configuration
COPY ./php-dev.ini $PHP_INI_DIR/conf.d/php-dev.ini

# Build Healthcheck
# HEALTHCHECK --interval=30s --timeout=10s --start-period=30s --retries=3 \
#     CMD php artisan health:check

# Copy the official MySQL client binaries
COPY --from=mysql /usr/bin/mysql /usr/bin/mysql
COPY --from=mysql /usr/bin/mysqldump /usr/bin/mysqldump
COPY --from=mysql /usr/bin/mysqladmin /usr/bin/mysqladmin

# Change the owner of the /var/html folder to allow tbuser to write to it
RUN chown appuser:www-data -R /var/www

# Finalize Image
USER appuser
WORKDIR /var/www/html
