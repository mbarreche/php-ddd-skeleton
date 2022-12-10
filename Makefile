.PONY: build composer-install composer-update composer reload run-tests start stop destroy rebuild start-local

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

build: start composer-install

# 🐘 Composer
composer-install: CMD=install
composer-update: CMD=update
composer composer-install composer-update:
	docker-compose run --rm --volume ${PWD}:/app php composer $(CMD)

# 🐳 Docker Compose
start: CMD=up -d
stop: CMD=stop
destroy: CMD=down
start stop destroy:
	@docker-compose $(CMD)

rebuild:
	docker-compose build --pull --force-rm --no-cache
	make composer-install
	make start

reload:
	docker-compose exec php kill -USR2 1
	docker-compose exec nginx nginx -s reload

run-tests:
	docker-compose run --rm php /app/vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml tests
	docker-compose run --rm php /app/vendor/bin/behat -p mooc_backend --format=progress -v

phpstan:
	docker-compose run --rm php /app/vendor/bin/phpstan analyse --xdebug -c etc/infrastructure/phpstan/phpstan.neon

phpstan-baseline:
	docker-compose run --rm php /app/vendor/bin/phpstan analyse \
	    --xdebug -c etc/infrastructure/phpstan/phpstan.neon --generate-baseline /app/etc/infrastructure/phpstan/phpstan-baseline.neon

http-get-health-check:
	curl http://127.0.0.1:8030/health-check

http-put-course:
	curl -X PUT --data name="ddd course" --data duration="500 hours" "http://127.0.0.1:8030/courses/1aab45ba-3c7a-4344-8936-78466eca77fa"

http-put-user:
	curl -X PUT --data name="John Smith" --data email=john.smith@mail.com --data password="abc123A_" "http://127.0.0.1:8030/users/1aab45ba-3c7a-4344-8936-78466eca77fa"

http-get-user:
	curl "http://127.0.0.1:8030/users/1aab45ba-3c7a-4344-8936-78466eca77fa"
