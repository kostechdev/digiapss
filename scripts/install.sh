#!/usr/bin/env bash
set -euo pipefail

PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$PROJECT_ROOT"

with_npm="false"
super_admin="true"

for arg in "$@"; do
  case "$arg" in
    --with-npm)
      with_npm="true"
      shift
      ;;
    --no-super-admin)
      super_admin="false"
      shift
      ;;
    *)
      ;;
  esac
done

need_cmd() { command -v "$1" >/dev/null 2>&1; }

if ! need_cmd php; then echo "php tidak ditemukan" >&2; exit 1; fi
if ! need_cmd composer; then echo "composer tidak ditemukan" >&2; exit 1; fi

if [ "$with_npm" = "true" ]; then
  if ! need_cmd npm; then echo "npm tidak ditemukan" >&2; exit 1; fi
fi

if [ ! -f .env ]; then
  if [ -f .env.example ]; then
    cp .env.example .env
  else
    echo ".env.example tidak ditemukan" >&2; exit 1
  fi
fi

composer install --no-interaction --prefer-dist --optimize-autoloader

if ! grep -qE '^APP_KEY=.+$' .env || grep -qE '^APP_KEY=\s*$' .env; then
  php artisan key:generate --ansi
fi

php artisan optimize:clear --no-interaction || true

if grep -qE '^DB_CONNECTION=sqlite' .env || \
   ! grep -qE '^DB_CONNECTION=' .env; then
  mkdir -p database
  if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
  fi
fi

if ! php artisan storage:link >/dev/null 2>&1; then
  true
fi

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction || true

if [ "$with_npm" = "true" ]; then
  if [ -f package-lock.json ]; then
    npm ci
  else
    npm install
  fi
  if npm run | grep -q " build"; then
    npm run build
  fi
fi

FILAMENT_NAME="${FILAMENT_NAME:-}"
FILAMENT_EMAIL="${FILAMENT_EMAIL:-}"
FILAMENT_PASSWORD="${FILAMENT_PASSWORD:-}"

if php artisan list | grep -q "make:filament-user"; then
  if [ -n "$FILAMENT_EMAIL" ] && [ -n "$FILAMENT_PASSWORD" ]; then
    args=( make:filament-user --no-interaction --email="$FILAMENT_EMAIL" --password="$FILAMENT_PASSWORD" )
    if [ -n "$FILAMENT_NAME" ]; then
      args+=( --name="$FILAMENT_NAME" )
    fi
    if [ "$super_admin" = "true" ]; then
      args+=( --super-admin )
    fi
    set +e
    php artisan "${args[@]}"
    rc=$?
    set -e
    if [ $rc -ne 0 ]; then
      echo "gagal membuat user Filament secara non-interaktif, jalankan manual: php artisan make:filament-user" >&2
    fi
  else
    echo "lewati pembuatan user Filament: set FILAMENT_EMAIL dan FILAMENT_PASSWORD untuk non-interaktif" >&2
  fi
else
  echo "perintah make:filament-user tidak tersedia" >&2
fi

echo "Selesai."
