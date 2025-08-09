#!/usr/bin/env bash
set -euo pipefail

PROJECT_NAME=festival-crew-planner

# 1) Laravel erstellen
composer create-project laravel/laravel "$PROJECT_NAME" --prefer-dist
cd "$PROJECT_NAME"

# 2) Auth (Breeze)
composer require laravel/breeze --dev
php artisan breeze:install blade

# 3) Admin (Filament)
composer require filament/filament:"^3.2" -W
php artisan vendor:publish --tag=filament-config --force || true

# 4) Env vorbereiten
cp .env .env.example.local
php artisan key:generate

# 5) NPM & Build (optional fürs erste)
npm install
npm run build || true

# 6) Models/Migrations aus MVP einfügen (Platzhalter – bitte Inhalte aus Canvas übertragen)
# Beispiel-Dateien werden angelegt; ersetzt sie bei Bedarf durch die hier dokumentierten Snippets.
mkdir -p database/migrations app/Models app/Policies app/Http/Controllers/Admin resources/views/festivals

# 7) Git initialisieren
git init
cat > .gitignore <<'GI'
/vendor
/node_modules
/public/build
/.env
/storage/*.key
/storage/app/public
/storage/logs
/bootstrap/cache/*.php
GI

git add .
git commit -m "chore: bootstrap Laravel + Breeze + Filament"

printf "
✅ Projekt '$PROJECT_NAME' erstellt. Als nächstes: GitHub-Repo anlegen und pushen.
"