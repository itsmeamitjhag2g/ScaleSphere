#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
PHP="${LOCALAPPDATA:-$HOME/AppData/Local}/Programs/php-8.3/php.exe"
if [[ ! -x "$PHP" && ! -f "$PHP" ]]; then
  PHP="/c/xampp/php/php.exe"
fi
if [[ ! -f "$PHP" ]]; then
  echo "PHP not found. Install PHP 8.3 or XAMPP, then reopen the terminal."
  exit 1
fi
# Bind the same name the browser opens: with 127.0.0.1, "localhost" first tries ::1
# and every request waits ~200 ms on Windows before falling back.
HOST="${HOST:-localhost}"
PORT="${PORT:-3000}"
echo "ScaleSphere: http://${HOST}:${PORT}"
cd "$ROOT"
exec "$PHP" -S "$HOST:$PORT" index.php
