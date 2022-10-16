DOCKER_CMD := docker-compose
ifeq ($(OS),Windows_NT)
  DOCKER_CMD := $(DOCKER_CMD) -f "%cd%\docker\docker-compose.yml"
else
  DOCKER_CMD := $(DOCKER_CMD) -f $$(pwd)/docker/docker-compose.yml
endif

DOCKER_CMD_PHP_CLI := $(DOCKER_CMD) exec php-fpm

nginx-console:
	$(DOCKER_CMD) exec nginx bash
php-console:
	$(DOCKER_CMD_PHP_CLI) bash
up:
	$(DOCKER_CMD) up
start:
	$(DOCKER_CMD) start
stop:
	$(DOCKER_CMD) stop
down:
	$(DOCKER_CMD) down --remove-orphans
rm:
	$(DOCKER_CMD) rm
build:
	$(DOCKER_CMD) up -d --force-recreate --build --remove-orphans
composer-install:
	$(DOCKER_CMD_PHP_CLI) composer install
composer-update:
	$(DOCKER_CMD_PHP_CLI) composer update
init-certificates:
	docker run --rm -v $$(pwd)/docker/nginx/ssl:/certificates -e "SERVER=localhost" -e "SUBJECT=/C=RU/ST=Russia/L=Russia/O=IT" jacoelho/generate-certificate
#Couldn't connect to Docker daemon at http+docker://localhost - is it running?
docker-add-user:
	sudo usermod -aG docker ${USER} & \
	su ${USER}
init: build composer-install
php-tests:
	$(DOCKER_CMD_PHP_CLI) php vendor/bin/codecept run --steps
