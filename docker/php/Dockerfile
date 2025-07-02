FROM php:8.4.8-fpm-alpine
RUN apk update
RUN apk upgrade
RUN apk add --no-cache tzdata bash mc;
ENV TZ = Europe/Budapest
RUN docker-php-ext-install mysqli
RUN mkdir /etc/ssl/pma
COPY ssl/client.key /etc/ssl/pma
RUN chmod 600 /etc/ssl/pma/client.key
RUN chown www-data:www-data /etc/ssl/pma/client.key
COPY ssl/client.crt /etc/ssl/pma
RUN chmod 644 /etc/ssl/pma/client.crt
RUN chown www-data:www-data /etc/ssl/pma/client.crt
COPY ssl/ca.crt /etc/ssl/pma
RUN chmod 644 /etc/ssl/pma/ca.crt
RUN chown www-data:www-data /etc/ssl/pma/ca.crt
WORKDIR /web
CMD ["php-fpm"]
