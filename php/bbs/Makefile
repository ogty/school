include .env

open:
	@open http://localhost:8000

init:
	@$(shell cp -n $(shell pwtd)/web/app/composer.json.dist $(shell pwd)/web/app/composer.json 2> /dev/null)

clean:
	@rm -Rf database/mysql/data/*
	@rm -Rf web/app/vendor
	@rm -Rf web/app/composer.lock
	@rm -Rf web/app/doc
	@rm -Rf web/app/report
	@rm -Rf etc/ssl/*

composer-up:
	@docker run --rm -v $(shell pwd)/web/app:/app composer update

docker-start: init
	docker-compose up -d

docker-stop:
	@docker-compose down -v
	@make clean

logs:
	@docker-compose logs -f

.PHONY: clean init
