clean:
	make flush
	reset
	rm -f docker.log
	podman-compose build --no-cache | tee -a docker.log
	podman-compose up | tee -a docker.log
terminal:
	podman exec -it "$$(podman ps -q -f name=mariadb-php)" /bin/bash
nginx:
	podman exec -it "$$(podman ps -q -f name=mariadb-nginx)" /bin/bash
mariadb:
	podman exec -it "$$(podman ps -q -f name=mariadb-server)" /bin/bash
flush:
	podman stop mariadb-nginx mariadb-php mariadb-server -i
	podman rm mariadb-nginx mariadb-php mariadb-server -f
	podman volume rm mariadb-nginx mariadb-php mariadb-server -f
	podman system prune -a -f
	podman image prune -a -f
	podman volume prune -f
