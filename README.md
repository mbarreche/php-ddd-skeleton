# DDD php Skeleton

## Installation
* To create docker for the first time and/or start all services: `make start`
* To install composer libraries: `make composer-install`
* To run all tests: `make run-tests`
* To generate baseline in phpstan: `make phpstan-baseline`

## How to make requests to the server
If you want to make a request to the server, here you have several examples:
* `make http-get-health-check`
* `make http-put-course`
