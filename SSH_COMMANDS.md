# SSH Commands untuk Hostinger - Portal Desa

## Koneksi SSH
```bash
# Format umum koneksi SSH Hostinger
ssh username@your-domain.com -p 65002
# atau menggunakan IP server
ssh username@server-ip -p 65002

# Contoh:
ssh u123456789@yourdomain.com -p 65002
```

## Setup Awal di Server

### 1. Navigasi ke Directory Web
```bash
# Untuk domain utama
cd public_html

# Untuk subdomain
cd domains/subdomain.yourdomain.com/public_html
```

### 2. Upload dan Extract Files
```bash
# Jika menggunakan wget untuk download dari GitHub/repository
wget https://github.com/yourusername/portaldesa/archive/main.zip
unzip main.zip
mv portaldesa-main/* .
mv portaldesa-main/.[^.]* .
rmdir portaldesa-main

# Atau jika sudah upload manual via FileManager:
unzip portaldesa.zip
```

### 3. Set Environment Variables
```bash
# Copy file environment
cp .env.production .env

# Edit dengan nano
nano .env
```

### 4. Install Dependencies
```bash
# Download composer jika belum ada
curl -sS https://getcomposer.org/installer | php

# Install dependencies Laravel
php composer.phar install --optimize-autoloader --no-dev --ignore-platform-reqs

# Atau jika composer global tersedia
composer install --optimize-autoloader --no-dev
```

### 5. Setup Laravel
```bash
# Generate application key
php artisan key:generate --force

# Set permissions
chmod -R 775 storage bootstrap/cache
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Create storage symlink
php artisan storage:link

# Clear and cache configs
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan view:cache
```

### 6. Database Setup
```bash
# Run migrations
php artisan migrate --force

# Seed database (optional)
php artisan db:seed --force
```

## Automated Deployment
```bash
# Make script executable
chmod +x hostinger-deploy.sh

# Run deployment script
./hostinger-deploy.sh
```

## Database Configuration Commands

### Create Database via SSH (if MySQL access available)
```bash
# Login to MySQL (jika tersedia)
mysql -u username -p

# Create database
CREATE DATABASE portal_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON portal_desa.* TO 'username'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Import Database
```bash
# Import database dari file SQL
mysql -u username -p database_name < database_backup.sql

# Atau jika file large, gunakan:
mysql -u username -p database_name --max_allowed_packet=1024M < database_backup.sql
```

## File Management Commands

### Backup Commands
```bash
# Backup database
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf backup_files_$(date +%Y%m%d).tar.gz --exclude='*.log' --exclude='storage/logs/*' .
```

### Permission Fixes
```bash
# Reset permissions if needed
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
chmod +x artisan
```

### Clear Cache Commands
```bash
# Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Recreate caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Monitoring Commands

### Check Logs
```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# View last 50 lines of log
tail -50 storage/logs/laravel.log

# View error logs by date
grep "$(date +%Y-%m-%d)" storage/logs/laravel.log
```

### System Information
```bash
# Check PHP version
php -v

# Check available PHP modules
php -m

# Check memory usage
free -h

# Check disk space
df -h
```

### Process Management
```bash
# Check running processes
ps aux | grep php

# Check active connections
netstat -tulpn | grep :80
```

## Troubleshooting Commands

### Common Issues
```bash
# If 500 error occurs
tail -50 storage/logs/laravel.log

# If permission denied
chmod -R 775 storage bootstrap/cache

# If composer memory issues
php -d memory_limit=512M composer.phar install --optimize-autoloader --no-dev

# If storage link doesn't work
rm public/storage
php artisan storage:link

# If config cache issues
php artisan config:clear
php artisan config:cache
```

### Database Connection Test
```bash
# Test database connection
php artisan tinker
# Then in tinker:
DB::connection()->getPdo();
exit
```

## Cron Jobs Setup (if needed)

### Edit Crontab
```bash
crontab -e

# Add Laravel scheduler (if your hosting supports it)
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

## Security Commands

### Update File Ownership (if needed)
```bash
# Change ownership to web server user
chown -R username:username storage bootstrap/cache

# Or to specific user
chown -R www-data:www-data storage bootstrap/cache
```

### Check Security
```bash
# Check for suspicious files
find . -name "*.php" -exec grep -l "eval\|base64_decode\|system\|exec" {} \;

# Check file permissions
find . -type f -perm 777
find . -type d -perm 777
```

## Performance Optimization

### Optimize Autoloader
```bash
composer dump-autoload --optimize --classmap-authoritative
```

### Clear OPcache (if available)
```bash
php -r "if(function_exists('opcache_reset')) { opcache_reset(); echo 'OPcache cleared'; } else { echo 'OPcache not available'; }"
```

## Update Commands

### Update Composer Dependencies
```bash
composer update --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan view:cache
```

### Laravel Framework Update
```bash
# Check current version
php artisan --version

# After updating composer.json
composer update laravel/framework --with-dependencies
php artisan migrate --force
```

## Notes for Hostinger Specific
- SSH port biasanya 65002
- PHP path mungkin `/usr/bin/php` atau `/opt/alt/php81/usr/bin/php`
- MySQL host biasanya `localhost`
- File manager tersedia di cPanel untuk upload file
- Beberapa command mungkin dibatasi pada shared hosting
