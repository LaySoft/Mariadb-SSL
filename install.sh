./generate_keys.sh
rm -Rf web/pma
mkdir web/pma
wget -P /tmp https://files.phpmyadmin.net/phpMyAdmin/5.2.2/phpMyAdmin-5.2.2-english.tar.gz
tar -xzf /tmp/phpMyAdmin-5.2.2-english.tar.gz -C /tmp
cp -R /tmp/phpMyAdmin-5.2.2-english/* web/pma
rm -R /tmp/phpMyAdmin-5.2.2-english /tmp/phpMyAdmin-5.2.2-english.tar.gz

cp docker/php/config.inc.php web/pma
cp docker/php/constants.php web/pma/libraries

make reset-database
