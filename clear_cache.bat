@echo off
echo Clearing Laravel caches...
del /Q storage\framework\views\*.php 2>nul
del /Q storage\framework\cache\data\* 2>nul
del /Q bootstrap\cache\config.php 2>nul
del /Q bootstrap\cache\routes*.php 2>nul
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
echo Done! Now run: php artisan serve
