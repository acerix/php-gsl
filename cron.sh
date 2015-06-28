#!/usr/bin/env bash
set -euo pipefail
IFS=$'\n\t'

cd script
./update_games.php
./update_servers.php
cd ..

