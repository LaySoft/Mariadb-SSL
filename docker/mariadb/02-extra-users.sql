CREATE USER 'maxscale_monitor'@'%' IDENTIFIED BY 'monitorpass';
GRANT SELECT ON mysql.* TO 'maxscale_monitor'@'%';
GRANT PROCESS ON *.* TO 'maxscale_monitor'@'%';
GRANT REPLICATION CLIENT ON *.* TO 'maxscale_monitor'@'%';
GRANT REPLICATION SLAVE ON *.* TO 'maxscale_monitor'@'%';
GRANT SLAVE MONITOR ON *.* TO 'maxscale_monitor'@'%';

CREATE USER 'maxscale_service'@'%' IDENTIFIED BY 'servicepass';
GRANT SELECT ON mysql.* TO 'maxscale_service'@'%';
GRANT SHOW DATABASES ON *.* TO 'maxscale_service'@'%';

GRANT SELECT ON mysql.user TO 'maxscale_service'@'%';
GRANT SELECT ON mysql.db TO 'maxscale_service'@'%';
GRANT SELECT ON mysql.procs_priv TO 'maxscale_service'@'%';
GRANT SELECT ON mysql.tables_priv TO 'maxscale_service'@'%';
GRANT SELECT ON mysql.columns_priv TO 'maxscale_service'@'%';
GRANT SELECT ON mysql.proxies_priv TO 'maxscale_service'@'%';

FLUSH PRIVILEGES;
