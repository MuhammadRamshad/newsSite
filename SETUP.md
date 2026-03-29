# Illuminated Magazine — Laravel Setup Guide

## Requirements
- PHP 8.2+
- MySQL 5.7+ / MariaDB 10.3+
- Composer
- Apache/Nginx with mod_rewrite enabled

## Installation Steps

### 1. Install Dependencies
```bash
composer install --no-dev --optimize-autoloader
```

### 2. Configure Environment
Edit `.env` and update these values:
```env
APP_URL=http://yourdomain.com         # your actual domain / localhost
DB_DATABASE=news                      # your MySQL database name
DB_USERNAME=root                      # your MySQL username
DB_PASSWORD=yourpassword              # your MySQL password
```

### 3. Generate App Key (if needed)
```bash
php artisan key:generate
```

### 4. Set Storage Permissions
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache   # on Linux/Apache
```

### 5. Create Storage Symlink
```bash
php artisan storage:link
```

### 6. Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Database Tables Expected
The app expects these MySQL tables (from your existing CMS):
- `tbl_news` — news articles
- `tbl_category` — categories
- `tbl_authors` — authors

## CSS & JS
All assets are pre-built and located in `public/assets/`:
- CSS: `public/assets/css/illuminated.css`
- JS: `public/assets/js/illuminated.js`
- Images: `public/assets/image/`

No npm build step required.

## Production Deployment
For production, update `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```
Then run:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
