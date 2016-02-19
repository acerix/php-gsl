#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'

for file in ./proto/*.proto
do
  ./vendor/centraldesktop/protobuf-php/protoc-gen-php.php -i ./proto/ -o ./proto/ $file
done

