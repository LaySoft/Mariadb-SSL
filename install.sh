openssl genrsa -out ssl/ca.key 2048
openssl req -x509 -new -nodes -key ssl/ca.key -subj "/CN=MyCA" -days 365 -out ssl/ca.crt

openssl genrsa -out ssl/server.key 2048
openssl req -new -key ssl/server.key -subj "/CN=mariadb" -out ssl/server.csr
openssl x509 -req -in ssl/server.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 100 -out ssl/server.crt -days 365

openssl genrsa -out ssl/client.key 2048
openssl req -new -key ssl/client.key -subj "/CN=php-app" -out ssl/client.csr
openssl x509 -req -in ssl/client.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 101 -out ssl/client.crt -days 365

#mkdir app/pma
