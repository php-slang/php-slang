#!/usr/bin/env bash
./vendor/bin/php-cs-fixer fix ./src
./vendor/bin/psalm
phpdbg -qrr vendor/bin/phpunit --coverage-clover clover.xml
php coverage-checker.php clover.xml 100
./vendor/bin/humbug
php mutation-checker.php humbug-log.json 65 # Someday it will be 100