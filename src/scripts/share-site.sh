#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
PHP="${PHP:-php}"
PORT="${PORT:-3000}"
if ! command -v "$PHP" >/dev/null 2>&1; then
  echo "PHP not found. Install PHP 8.1+ and reopen the terminal."
  exit 1
fi
if ! command -v cloudflared >/dev/null 2>&1; then
  echo "cloudflared not found. Install it from https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/downloads/"
  exit 1
fi
cd "$ROOT"
"$PHP" -S "127.0.0.1:$PORT" index.php >/tmp/scalesphere-php.log 2>&1 &
PHP_PID=$!
trap 'kill "$PHP_PID" 2>/dev/null || true' EXIT INT TERM
echo "ScaleSphere is running locally at http://127.0.0.1:$PORT"
echo "Starting public tunnel. Copy the https:// URL printed by cloudflared."
cloudflared tunnel --url "http://127.0.0.1:$PORT"