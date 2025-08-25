FROM docker.io/mariadb/maxscale:latest
RUN dnf install -y mc telnet
COPY docker/maxscale/maxscale.cnf /etc/maxscale.cnf
