#!/bin/bash
set -e

echo "→ Bajando cambios..."
git pull

echo "→ Instalando dependencias..."
npm install

echo "→ Compilando assets..."
npm run build

echo "→ Limpiando cache..."
php artisan config:clear
php artisan view:clear

echo "✓ Deploy completado"
