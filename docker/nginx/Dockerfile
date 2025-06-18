FROM docker.io/library/nginx:stable-alpine
RUN apk update
RUN apk upgrade
RUN apk add --no-cache tzdata bash mc
ENV TZ = Europe/Budapest
COPY ./docker/nginx/site.conf /etc/nginx/conf.d/default.conf
