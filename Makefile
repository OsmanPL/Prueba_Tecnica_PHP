.PHONY: init up down composer-install test

init: up composer-install

up:
	docker-compose up --build -d

down:
	docker-compose down

composer-install:
	docker-compose run --rm php composer install

test:
	docker-compose run --rm php vendor/bin/phpunit --bootstrap vendor/autoload.php app/test