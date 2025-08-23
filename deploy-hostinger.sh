#!/bin/bash

# Script Deployment untuk Hostinger
# Portal Desa Laravel Project

echo "=========================================="
echo "PORTAL DESA DEPLOYMENT SCRIPT - HOSTINGER"
echo "=========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found. Make sure you're in the Laravel project root directory."
    exit 1
fi

print_status "Starting deployment process..."

# 1. Set proper permissions
print_status "Setting file permissions..."
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 644 .env

# 2. Create .htaccess for subdomain/main domain
print_status "Creating .htaccess file..."
cat > .htaccess << 'EOL'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Handle Angular and AngularJS requests
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L]
    
    # Redirect to public folder for direct access
    RewriteCond %{THE_REQUEST} /public/([^\s?]*) [NC]
    RewriteRule ^ /%1 [NC,L,R]
</IfModule>

# Disable directory browsing
Options -Indexes

# Protect sensitive files
<FilesMatch "\.(env|git|htaccess)">
    Order allow,deny
    Deny from all
</FilesMatch>
EOL

# 3. Update composer (if available)
if command -v composer &> /dev/null; then
    print_status "Updating Composer dependencies..."
    composer install --optimize-autoloader --no-dev
    if [ $? -ne 0 ]; then
        print_warning "Composer install failed. Trying with memory limit increase..."
        php -d memory_limit=512M $(which composer) install --optimize-autoloader --no-dev
    fi
else
    print_warning "Composer not found. You may need to install dependencies manually."
fi

# 4. Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    print_status "Generating application key..."
    php artisan key:generate --force
fi

# 5. Clear and cache configurations
print_status "Clearing and caching configurations..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Create symlink for storage (if not exists)
if [ ! -L "public/storage" ]; then
    print_status "Creating storage symlink..."
    php artisan storage:link
fi

# 7. Run database migrations (with confirmation)
read -p "Do you want to run database migrations? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    print_status "Running database migrations..."
    php artisan migrate --force
fi

# 8. Optimize for production
print_status "Optimizing for production..."
php artisan optimize

# 9. Create logs directory if not exists
mkdir -p storage/logs
chmod 775 storage/logs

print_status "Deployment completed successfully!"
print_status "=========================================="
print_status "NEXT STEPS:"
print_status "1. Update your .env file with correct database credentials"
print_status "2. Point your domain to this directory"
print_status "3. Set up SSL certificate"
print_status "4. Configure cron jobs if needed"
print_status "=========================================="
