up: up-d yarn-run_dev
init: .env composer-install up-d key-generate refresh-db yarn-install yarn-build
start: up-d refresh-db yarn-run_dev
restart: down up
refresh: restart refresh-db
clear-tail: clear-log tailog
up-d:
	./vendor/bin/sail up -d
down:
	./vendor/bin/sail down
ps:
	./vendor/bin/sail ps
sh:
	./vendor/bin/sail shell
refresh-db:
	./vendor/bin/sail artisan migrate:fresh --seed
optimize:
	./vendor/bin/sail artisan optimize
key-generate:
	./vendor/bin/sail artisan key:generate
yarn-run_dev:
	./vendor/bin/sail yarn run dev &
yarn-build:
	./vendor/bin/sail yarn run build
yarn-install:
	./vendor/bin/sail yarn install
.env:
	cp ./.env.example ./.env
composer-install:
	./vendor/bin/sail composer install
tailog:
	tail -f ./storage/logs/laravel.log
clear-log:
	echo "" > ./storage/logs/laravel.log
