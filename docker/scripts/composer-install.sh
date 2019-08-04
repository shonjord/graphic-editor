#!/usr/bin/env bash
source docker/scripts/env

echo -e "$INFO_COLOR==> Installing PHP dependencies$NO_COLOR"
composer install --prefer-dist --no-interaction --no-progress --ignore-platform-reqs
composer dump-autoload -o
