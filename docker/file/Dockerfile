FROM php:7.3.7-cli-stretch

# Send context to container
ENV APP_DIR /cli/ge

# Copying the App Directory
COPY . $APP_DIR

# Working Dictory of the Application
WORKDIR $APP_DIR

ENV PHP_XDEBUG_DEFAULT_ENABLE="0" \
    PHP_XDEBUG_REMOTE_ENABLE="0" \
    PHP_XDEBUG_REMOTE_HOST="" \
    PHP_XDEBUG_REMOTE_PORT="9000" \
    PHP_XDEBUG_REMOTE_AUTO_START="0" \
    PHP_XDEBUG_REMOTE_CONNECT_BACK="0" \
    PHP_XDEBUG_IDEKEY="debugit" \
    PHP_XDEBUG_PROFILER_ENABLE="0" \
    PHP_XDEBUG_PROFILER_OUTPUT_DIR="/tmp" \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

# PHP installations
RUN apt-get update && \
    apt-get install -y \
    libpng-dev && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    # Configure extensions
    docker-php-ext-configure opcache --enable-opcache &&\
    docker-php-ext-install gd && \
    # Install PHP extensions
    docker-php-ext-install \
        opcache && \
    pecl install -o -f \
        xdebug && \
    docker-php-ext-enable \
        xdebug && \
    echo "xdebug.default_enable=${PHP_XDEBUG_DEFAULT_ENABLE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_enable=\${PHP_XDEBUG_REMOTE_ENABLE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_port=\${PHP_XDEBUG_REMOTE_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_autostart=${PHP_XDEBUG_REMOTE_AUTO_START}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_connect_back=${PHP_XDEBUG_REMOTE_CONNECT_BACK}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.idekey=${PHP_XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.profiler_enable=${PHP_XDEBUG_PROFILER_ENABLE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.profiler_output_dir=${PHP_XDEBUG_PROFILER_OUTPUT_DIR}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  && \
    echo "xdebug.remote_host=\${PHP_XDEBUG_REMOTE_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

## INSTALL APPLICATION DEPENDENCIES
RUN cp ./docker/op-cache/config.ini /usr/local/etc/php/conf.d/op-cache.ini && \
    composer install --quiet --no-progress --no-suggest --optimize-autoloader && \
    touch /var/log/app.log

CMD ["tail", "-f", "/var/log/app.log"]
