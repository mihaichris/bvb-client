test:
	./vendor/bin/pest --parallel

test-coverage:
	./vendor/bin/pest --coverage-html --parallel build/coverage

unit-test:
	./vendor/bin/pest --testsuite=Unit --parallel

feature-test:
	./vendor/bin/pest --testsuite=Feature --parallel

mutation-test:
	XDEBUG_MODE=coverage ./vendor/bin/infection --test-framework=pest --show-mutations

static-analysis:
	@echo "Running PHP Stan"
	./vendor/bin/phpstan analyze ./src/
	@echo "Running PHP CodeSniffer"
	./vendor/bin/phpcs --standard=PSR12 ./src/
	@echo "Running Psalm"
	./vendor/bin/psalm

build: static-analysis test mutation-test