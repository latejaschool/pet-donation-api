FROM php:7.4-fpm-alpine

RUN apk add --update --no-cache libintl icu icu-dev postgresql-dev pcre-dev $PHPIZE_DEPS \
 && pecl install redis xdebug \
 && docker-php-ext-enable xdebug redis \
 && docker-php-ext-install intl pdo pdo_pgsql \
 && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
 && sed -i 's/variables_order = "GPCS"/variables_order = "EGPCS"/g' /usr/local/etc/php/php.ini-*

ARG APP_ENV
ENV APP_ENV=${APP_ENV:-prod}

RUN if [ "$APP_ENV" = "prod" ]; then \
        cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
        docker-php-ext-install opcache && \
        echo "opcache.memory_consumption=256" > /usr/local/etc/php/conf.d/opcache.ini && \
        echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini && \
        echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
        echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/opcache.ini && \
        echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/opcache.ini; \
    else \
        apk add --update --no-cache libzip-dev && \
        docker-php-ext-configure zip && \
        docker-php-ext-install zip && \
        cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; \
    fi

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer