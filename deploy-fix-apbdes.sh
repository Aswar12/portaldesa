#!/bin/bash

echo "=== APBDes Fix Deployment Script ==="
echo "Starting deployment at $(date)"

# 1. Backup database (optional but recommended)
echo "1. Creating database backup..."
# php artisan backup:run --only-db

# 2. Run migrations
echo "2. Running migrations..."
php artisan migrate --force

# 3. Clear all caches
echo "3. Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# 4. Recreate optimized files
echo "4. Recreating optimized files..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Update existing data
echo "5. Updating existing anggaran data..."
php artisan db:seed --class=UpdateAnggaranInfografisSeeder --force

# 6. Set proper permissions
echo "6. Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework

echo "=== Deployment completed at $(date) ==="
echo "Check the website now: https://kadunjaya.kampungku.online/admin/apbdes"
