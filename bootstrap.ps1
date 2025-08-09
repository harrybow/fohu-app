$Project = "festival-crew-planner"

# 1) Laravel erstellen
composer create-project laravel/laravel $Project --prefer-dist
Set-Location $Project

# 2) Breeze (Auth)
composer require laravel/breeze --dev
php artisan breeze:install blade

# 3) Filament (Admin)
composer require filament/filament:"^3.2" -W
php artisan vendor:publish --tag=filament-config --force

# 4) ENV & Key
Copy-Item .env .env.example.local -Force
php artisan key:generate

# 5) NPM Build (optional)
npm install
npm run build

# 6) Basis-Ordner
New-Item -ItemType Directory -Force -Path "database/migrations"
New-Item -ItemType Directory -Force -Path "app/Models"
New-Item -ItemType Directory -Force -Path "app/Policies"
New-Item -ItemType Directory -Force -Path "app/Http/Controllers/Admin"
New-Item -ItemType Directory -Force -Path "resources/views/festivals"

# 7) Git init
& git init
Set-Content .gitignore @"
vendor/
node_modules/
public/build
.env
storage/*.key
storage/app/public
storage/logs
bootstrap/cache/*.php
"@

& git add .
& git commit -m "chore: bootstrap Laravel + Breeze + Filament"

Write-Host "✅ Projekt erstellt. Weiter mit: GitHub-Remote setzen & pushen."