rm -Rf ssl
mkdir ssl
openssl ecparam -name secp521r1 -genkey -noout -out ssl/ca.key
openssl req -x509 -new -nodes -key ssl/ca.key -subj "/CN=MyCA" -days 365 -out ssl/ca.crt

openssl ecparam -name secp521r1 -genkey -noout -out ssl/server.key
openssl req -new -key ssl/server.key -subj "/CN=mariadb" -out ssl/server.csr
openssl x509 -req -in ssl/server.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 100 -out ssl/server.crt -days 365

openssl ecparam -name secp521r1 -genkey -noout -out ssl/client.key
openssl req -new -key ssl/client.key -subj "/CN=php-app" -out ssl/client.csr
openssl x509 -req -in ssl/client.csr -CA ssl/ca.crt -CAkey ssl/ca.key -set_serial 101 -out ssl/client.crt -days 365

rm -Rf web/pma
mkdir web/pma
wget -P /tmp https://files.phpmyadmin.net/phpMyAdmin/5.2.2/phpMyAdmin-5.2.2-english.tar.gz
tar -xzf /tmp/phpMyAdmin-5.2.2-english.tar.gz -C /tmp
cp -R /tmp/phpMyAdmin-5.2.2-english/* web/pma
rm -R /tmp/phpMyAdmin-5.2.2-english /tmp/phpMyAdmin-5.2.2-english.tar.gz

cp docker/php/config.inc.php web/pma

sudo rm -Rf _STORAGE
mkdir _STORAGE
