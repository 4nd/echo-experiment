PHP_CONTAINER_RAW = $(shell docker ps -aqf name=echo-php)
PHP_CONTAINER = $(strip ${PHP_CONTAINER_RAW})
PHP_COMMAND_PREFIX = docker exec -it ${PHP_CONTAINER}

init:
	@docker-compose up -d --build

down:
	@docker-compose down

up:
	@docker-compose up -d

ci:
	@${PHP_COMMAND_PREFIX} composer install -n

sh:
	@${PHP_COMMAND_PREFIX} bash

start-workers:
	@${PHP_COMMAND_PREFIX} supervisord -c /etc/supervisor/supervisord.conf
	@${PHP_COMMAND_PREFIX} supervisorctl status all

status-workers:
	@${PHP_COMMAND_PREFIX} supervisorctl status all

stop-workers:
	@${PHP_COMMAND_PREFIX} supervisorctl stop all

restart-workers:
	@${PHP_COMMAND_PREFIX} supervisorctl restart all
