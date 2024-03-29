all: help
.PHONY: help status build composer-install build-container start stop down destroy shell test hooks run-tests

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

help: Makefile
	@sed -n 's/^##//p' $<

## status:	Show containers status
status:
	@docker-compose ps

## build:		Start container and install packages
build: build-container start hooks composer-install mimi

build-container:
	@docker-compose up --build --force-recreate --no-deps -d

## start:		Start container
start:
	@docker-compose up -d

## stop:		Stop containers
stop:
	@docker-compose stop

## down:		Stop containers and remove stopped containers and any network created
down:
	@docker-compose down

## destroy:	Stop containers and remove its volumes (all information inside volumes will be lost)
destroy:
	@docker-compose down -v

## shell:		Interactive shell inside docker
shell:
	@docker-compose exec php_container sh

composer-install:
	docker-compose exec php_container composer install

## test:		Run all tests inside docker
test:
	@docker-compose exec php_container make run-tests

## cc:		Regenerate app cache
cc:
	@docker-compose exec php_container php apps/BookingTrackerApi/bin/console cache:clear

run-tests:
	XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml tests

hooks:
	rm -rf .git/hooks
	ln -s ../docs/git/hooks-docker .git/hooks

mimi:
	@docker-compose exec php_container php apps/BookingTrackerApi/bin/console  doctrine:migrations:migrate --no-interaction
