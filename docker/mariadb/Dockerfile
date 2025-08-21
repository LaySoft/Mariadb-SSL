FROM docker.io/library/mariadb:12.1.1-noble-rc
#FROM docker.io/library/mariadb:12.0.2-noble
#FROM docker.io/library/mariadb:11.8.3-noble
#FROM docker.io/library/mariadb:11.4.8-noble
#FROM docker.io/library/mariadb:11.3.2-jammy
#FROM docker.io/library/mariadb:11.2.6-jammy
#FROM docker.io/library/mariadb:11.2.2-jammy
#FROM docker.io/library/mariadb:10.11.14-jammy
#FROM docker.io/library/mariadb:10.6.23-jammy
RUN apt update
RUN apt -y install mc mariadb-plugin-connect mariadb-plugin-s3
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
