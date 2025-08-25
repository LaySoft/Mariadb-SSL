FROM docker.io/mariadb/maxscale:latest
RUN dnf install -y mc procps-ng && dnf clean all
COPY docker/maxscale/maxscale.cnf /etc/maxscale.cnf
