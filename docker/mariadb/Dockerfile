#FROM docker.io/library/mariadb:11.8.2
FROM docker.io/library/mariadb:12.0.1-noble-rc
RUN apt update
RUN apt -y install mc
COPY docker/mariadb/custom.cnf /etc/mysql/conf.d/
RUN chmod 644 /etc/mysql/conf.d/custom.cnf
RUN mkdir /etc/mysql/ssl
COPY ssl/server.key /etc/mysql/ssl
RUN chmod 600 /etc/mysql/ssl/server.key
RUN chown mysql:mysql /etc/mysql/ssl/server.key
COPY ssl/server.crt /etc/mysql/ssl
RUN chmod 644 /etc/mysql/ssl/server.crt
RUN chown mysql:mysql /etc/mysql/ssl/server.crt
COPY ssl/ca.crt /etc/mysql/ssl
RUN chmod 644 /etc/mysql/ssl/ca.crt
RUN chown mysql:mysql /etc/mysql/ssl/ca.crt
