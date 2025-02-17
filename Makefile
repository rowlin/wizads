up: up-d
init: .env composer-install up-d key-generate refresh-db npm-install npm-build
start: up-d refresh-db npm-dev queue
refresh-db: fresh-db seed-db optimize-clear
restart: down up
refresh: npm-build restart
clear-tail: clear-log tailog
up-d:
	./vendor/bin/sail up -d
down:
	./vendor/bin/sail down
ps:
	./vendor/bin/sail ps
sh:
	./vendor/bin/sail shell
optimize:
	./vendor/bin/sail artisan optimize
key-generate:
	./vendor/bin/sail artisan key:generate
npm-install:
	npm install
.env:
	cp ./.env.example ./.env
refresh-db: 
	./vendor/bin/sail artisan migrate:fresh --seed
composer-install:
	./vendor/bin/sail composer install
tailog:
	tail -f ./storage/logs/laravel.log
clear-log:
	echo "" > ./storage/logs/laravel.log
