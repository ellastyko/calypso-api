OS := $(shell uname)
ARTISAN := php artisan
DC := docker-compose exec
FPM := $(DC) php-fpm

setup: env deps up migrate seeds chmod
start: up watch
build: env deps up npm-build

env:
	cp .env.example .env

deps:
	composer install
	npm install


restart: down up

up:
	./vendor/bin/sail up -d --build

down:
	./vendor/bin/sail down

keygen:
	$(ARTISAN) key:generate

migrate:
	$(ARTISAN) migrate

refresh:
	$(ARTISAN) migrate:refresh

fresh:
	$(ARTISAN) migrate:fresh

seeds:
	$(ARTISAN) db:seed

optimize:
	$(ARTISAN) optimize:clear

chmod:
	sudo chmod -R 777 storage

watch:
	npm run watch

npm-build:
	npm run build

serve:
	$(ARTISAN) serve

schedule:
	$(ARTISAN) schedule:run

route:
	$(ARTISAN) route:list

test:
	$(ARTISAN) test

phpcs:
	./vendor/bin/phpcs --standard=./phpcs.xml

phpcbf:
	./vendor/bin/phpcbf --standard=./phpcs.xml

phpmd:
	sudo ./vendor/bin/phpmd app xml phpmd.xml  --reportfile phpmd-report.xml
