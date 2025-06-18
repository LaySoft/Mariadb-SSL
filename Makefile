clean:
	make flush
	reset
	rm -f docker.log
	podman-compose build --no-cache | tee -a docker.log
	podman-compose up | tee -a docker.log
terminal:
	podman exec -it "$$(podman ps -q -f name=php)" /bin/bash
nginx:
	podman exec -it "$$(podman ps -q -f name=nginx)" /bin/bash
mariadb:
	podman exec -it "$$(podman ps -q -f name=server)" /bin/bash
flush:
	podman stop -a -i
	podman rm -a -f
	podman system prune -a -f
	podman image prune -a -f
	podman volume rm -a -f
	podman volume prune -f
