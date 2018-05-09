#!/usr/bin/env bash
set -ev
# vendor/bin/psalm
vendor/bin/phpcs --config-set colors 1
vendor/bin/php-cs-fixer fix --dry-run
vendor/bin/phpcs --error-severity=1 src test
vendor/bin/phpmd src text phpmd.xml
phpdbg -qrr vendor/bin/phpunit --coverage-clover clover.xml
php coverage-checker.php clover.xml 100
vendor/bin/infection --coverage=coverage --min-covered-msi=65
