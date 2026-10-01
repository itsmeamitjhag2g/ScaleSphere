#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
PHP="${PHP:-php}"
if ! command -v "$PHP" >/dev/null 2>&1; then
  for p in "${LOCALAPPDATA:-$HOME/AppData/Local}/Programs/php-8.3/php.exe" "/c/xampp/php/php.exe"; do
    [ -f "$p" ] && PHP="$p" && break
  done
fi
PORT="${PORT:-3000}"
CLOUDFLARED="${CLOUDFLARED:-cloudflared}"
if ! command -v "$CLOUDFLARED" >/dev/null 2>&1 && [ -n "${LOCALAPPDATA:-}" ]; then
  WIN_CF="$(cygpath -u "$LOCALAPPDATA" 2>/dev/null || echo "$LOCALAPPDATA")/cloudflared/cloudflared.exe"
  [ -f "$WIN_CF" ] && CLOUDFLARED="$WIN_CF"
fi
if ! command -v "$CLOUDFLARED" >/dev/null 2>&1; then
  echo "cloudflared not found. Install it from https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/downloads/"
  exit 1
fi
cd "$ROOT"
if (echo >"/dev/tcp/127.0.0.1/$PORT") >/dev/null 2>&1; then
  echo "ScaleSphere is already running at http://127.0.0.1:$PORT"
else
  if ! command -v "$PHP" >/dev/null 2>&1; then
    echo "PHP not found. Install PHP 8.1+ and reopen the terminal."
    exit 1
  fi
  "$PHP" -S "127.0.0.1:$PORT" index.php >/tmp/scalesphere-php.log 2>&1 &
  PHP_PID=$!
  trap 'kill "$PHP_PID" 2>/dev/null || true' EXIT INT TERM
  echo "ScaleSphere is running locally at http://127.0.0.1:$PORT"
fi
echo "Starting public tunnel. Copy the https:// URL printed by cloudflared."
"$CLOUDFLARED" tunnel --url "http://127.0.0.1:$PORT"
