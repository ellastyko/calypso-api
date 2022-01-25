OS := $(shell uname)
ARTISAN := php artisan

setup: env deps up migrate seeds watch
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


migrate:
	$(ARTISAN) migrate

refresh:
	$(ARTISAN) migrate:refresh

seeds:
	$(ARTISAN) db:seed

clear:
	$(ARTISAN) route:clear
	$(ARTISAN) cache:clear
	$(ARTISAN) config:clear

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
