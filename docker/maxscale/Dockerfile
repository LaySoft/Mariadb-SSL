FROM docker.io/mariadb/maxscale:latest
RUN dnf install -y mc telnet
COPY docker/maxscale/maxscale.cnf /etc/maxscale.cnf

RUN mkdir /etc/maxscale/
RUN mkdir /etc/maxscale/ssl/
COPY ssl/server.key /etc/maxscale/ssl/
RUN chmod 600 /etc/maxscale/ssl/server.key
RUN chown maxscale:maxscale /etc/maxscale/ssl/server.key
COPY ssl/server.crt /etc/maxscale/ssl/
RUN chmod 644 /etc/maxscale/ssl/server.crt
RUN chown maxscale:maxscale /etc/maxscale/ssl/server.crt
COPY ssl/ca.crt /etc/maxscale/ssl/
RUN chmod 644 /etc/maxscale/ssl/ca.crt
RUN chown maxscale:maxscale /etc/maxscale/ssl/ca.crt
