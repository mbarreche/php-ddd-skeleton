.PHONY: build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild start-local

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
build: deps start
deps: composer-install

composer-install:
	docker run --rm -it --volume $(current-dir):/app php-ddd-skeleton_php composer install --ignore-platform-reqs --no-ansi --no-interaction

composer-update:
	docker run --rm -it --volume $(current-dir):/app php-ddd-skeleton_php composer update $(args) -W --ignore-platform-reqs --no-ansi --no-interaction

composer-require:
	docker run --rm -it --volume $(current-dir):/app php-ddd-skeleton_php composer require $(args)

reload:
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

test:
	docker-compose exec php make run-tests

run-tests:
	mkdir -p build/test_results/phpunit
	./vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml tests
	./vendor/bin/behat -p mooc_backend --format=progress -v

start: CMD=up -d
stop: CMD=stop
destroy: CMD=down

doco start stop destroy:
	@docker-compose $(CMD)

rebuild:
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

start-local:
	docker-compose exec php symfony serve --dir=apps/mooc/backend/public --port=8030 -d --no-tls
	docker-compose exec php symfony serve --dir=apps/backoffice/frontend/public --port=8032 -d --no-tls
	docker-compose exec php symfony serve --dir=apps/backoffice/backend/public --port=8034 -d --no-tls

stop-local:
	docker-compose exec php symfony server:stop --dir=apps/mooc/backend/public
	docker-compose exec php symfony server:stop --dir=apps/backoffice/frontend/public
	docker-compose exec php symfony server:stop --dir=apps/backoffice/backend/public

exec-endpoint:
	docker-compose exec php curl -I http://127.0.0.1:8030/health-check
	docker-compose exec php curl -I http://127.0.0.1:8032/health-check
	docker-compose exec php curl -I http://127.0.0.1:8034/health-check

