.DEFAULT_GOAL := help
.PHONY: help build migrate
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[%a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

docker_file=./.docker/docker-compose.yaml

APP_CONTAINER=php-fpm
MYSQL_CONTAINER=mysql
NGINX_CONTAINER=nginx

up: ## Start all containers (in background) for development
	docker-compose -f ${docker_file} up -d

down: ## Stop all started for development containers
	docker-compose -f ${docker_file} down -v --remove-orphans

init: ## Build container, init db and apply fixtures
	make build up app-init migrate apply-seeds

restart: ## Restart all started for development containers
	docker-compose -f ${docker_file} restart

build: ## Build all containers
	docker-compose -f ${docker_file} rm -vsf
	docker-compose -f ${docker_file} down -v --remove-orphans
	docker-compose -f ${docker_file} build

migrate: ## Runs application migrations.
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} php ./vendor/bin/phinx migrate

create-seed: ## Create seeds (make create-seed name=<new_seed_name>).
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} php vendor/bin/phinx seed:create $(name)

apply-seeds: ## Apply all seeds.
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} php vendor/bin/phinx seed:run

app-init: ## Init application (composer install).
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} composer install --no-interaction

jumpin: ## Start shell into application container
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} /bin/bash

run-test: ## Run tests in container
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} php ./bin/phpunit $(param)

create_migration: ## Create new migration.
	docker-compose -f ${docker_file} exec ${APP_CONTAINER} ./vendor/bin/phinx create $(name)

tail-logs: ## Display all logs from containers
	docker-compose -f ${docker_file} logs -f ${APP_CONTAINER}

dps: ## Status docker containers
	docker-compose -f ${docker_file} ps
