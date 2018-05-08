#!/usr/bin/env bash
set -xe
#./vendor/bin/psalm
./vendor/bin/phpcs --config-set colors 1
./vendor/bin/phpcs --standard=PSR2 --error-severity=1 --standard=phpcs.xml ./src
./vendor/bin/phpmd ./src text phpmd.xml
phpdbg -qrr vendor/bin/phpunit --coverage-clover clover.xml
php coverage-checker.php clover.xml 100
./vendor/bin/infection --coverage=coverage --min-covered-msi=65
