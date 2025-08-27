CREATE USER 'maxscale_monitor'@'%' IDENTIFIED BY 'monitorpass';
GRANT SELECT ON mysql.* TO 'maxscale_monitor'@'%';
GRANT PROCESS ON *.* TO 'maxscale_monitor'@'%';
GRANT REPLICATION CLIENT ON *.* TO 'maxscale_monitor'@'%';
GRANT REPLICATION SLAVE ON *.* TO 'maxscale_monitor'@'%';
GRANT SLAVE MONITOR ON *.* TO 'maxscale_monitor'@'%';
FLUSH PRIVILEGES;
