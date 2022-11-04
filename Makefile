start:
	docker-compose up -d

down:
	docker-compose down

rebuild:
	docker-compose up --build

migrate:
	php artisan migrate

rollback:
	php artisan migrate:rollback

dbrebuild:
	php artisan migrate:rollback && php artisan migrate