#!/usr/bin/env bash
composer install -n --no-progress || composer remove --dev friendsofphp/php-cs-fixer -n --no-progress
