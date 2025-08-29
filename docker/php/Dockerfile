FROM php:8.5.0beta2-fpm-alpine
RUN apk update
RUN apk upgrade
RUN apk add --no-cache tzdata bash mc mariadb-client;
ENV TZ = Europe/Budapest
RUN docker-php-ext-install mysqli
RUN mkdir /etc/ssl/pma
COPY ssl/php_client.key /etc/ssl/pma
RUN chmod 600 /etc/ssl/pma/php_client.key
RUN chown www-data:www-data /etc/ssl/pma/php_client.key
COPY ssl/php_client.crt /etc/ssl/pma
RUN chmod 644 /etc/ssl/pma/php_client.crt
RUN chown www-data:www-data /etc/ssl/pma/php_client.crt
COPY ssl/ca.crt /etc/ssl/pma
RUN chmod 644 /etc/ssl/pma/ca.crt
RUN chown www-data:www-data /etc/ssl/pma/ca.crt
COPY docker/php/php.ini /usr/local/etc/php/conf.d/
WORKDIR /web
CMD ["php-fpm"]
