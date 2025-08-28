FROM docker.io/mariadb/maxscale:latest
RUN dnf install -y mc telnet
COPY docker/maxscale/maxscale.cnf /etc/maxscale.cnf

RUN mkdir /etc/maxscale/
RUN mkdir /etc/maxscale/ssl/
COPY ssl/maxscale_server.key /etc/maxscale/ssl/
RUN chmod 600 /etc/maxscale/ssl/maxscale_server.key
RUN chown maxscale:maxscale /etc/maxscale/ssl/maxscale_server.key
COPY ssl/maxscale_server.crt /etc/maxscale/ssl/
RUN chmod 644 /etc/maxscale/ssl/maxscale_server.crt
RUN chown maxscale:maxscale /etc/maxscale/ssl/maxscale_server.crt
COPY ssl/ca.crt /etc/maxscale/ssl/
RUN chmod 644 /etc/maxscale/ssl/ca.crt
RUN chown maxscale:maxscale /etc/maxscale/ssl/ca.crt
