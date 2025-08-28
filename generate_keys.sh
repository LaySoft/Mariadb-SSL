rm -Rf ssl
mkdir ssl
openssl ecparam -name secp521r1 -genkey -noout -out ssl/ca.key
openssl req -x509 -new -nodes -key ssl/ca.key -subj "/CN=LaySoftCA" -days 999999 -out ssl/ca.crt

openssl ecparam -name secp521r1 -genkey -noout -out ssl/mariadb_server.key
openssl req -new -key ssl/mariadb_server.key -subj "/CN=mariadb" -out ssl/mariadb_server.csr
openssl x509 -req -in ssl/mariadb_server.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 100 -out ssl/mariadb_server.crt -days 999999

openssl ecparam -name secp521r1 -genkey -noout -out ssl/maxscale_server.key
openssl req -new -key ssl/maxscale_server.key -subj "/CN=maxscale" -out ssl/maxscale_server.csr
openssl x509 -req -in ssl/maxscale_server.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 100 -out ssl/maxscale_server.crt -days 999999

openssl ecparam -name secp521r1 -genkey -noout -out ssl/php_client.key
openssl req -new -key ssl/php_client.key -subj "/CN=php-app" -out ssl/php_client.csr
openssl x509 -req -in ssl/php_client.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 101 -out ssl/php_client.crt -days 999999
