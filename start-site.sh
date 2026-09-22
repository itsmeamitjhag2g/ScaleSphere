#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")" && pwd)"
PHP="${LOCALAPPDATA:-$HOME/AppData/Local}/Programs/php-8.3/php.exe"
if [[ ! -x "$PHP" && ! -f "$PHP" ]]; then
  PHP="/c/xampp/php/php.exe"
fi
if [[ ! -f "$PHP" ]]; then
  echo "PHP not found. Install PHP 8.3 or XAMPP, then reopen the terminal."
  exit 1
fi
HOST="${HOST:-127.0.0.1}"
PORT="${PORT:-3000}"
echo "ScaleSphere: http://${HOST}:${PORT}"
exec "$PHP" -S "$HOST:$PORT" "$ROOT/index.php"
