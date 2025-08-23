#!/bin/bash

# Portal Desa - Hostinger Deployment Script
# Optimized for Hostinger shared hosting environment

echo "============================================"
echo "PORTAL DESA - HOSTINGER DEPLOYMENT"
echo "============================================"

# Colors for better visibility
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Function to print colored output
info() { echo -e "${GREEN}[INFO]${NC} $1"; }
warn() { echo -e "${YELLOW}[WARN]${NC} $1"; }
error() { echo -e "${RED}[ERROR]${NC} $1"; }
section() { echo -e "${BLUE}[STEP]${NC} $1"; }

# Check if in Laravel project directory
if [ ! -f "artisan" ]; then
    error "Laravel artisan file not found!"
    error "Please run this script from Laravel project root directory."
    exit 1
fi

section "1. Environment Check"
info "Checking PHP version..."
php -v

info "Current directory: $(pwd)"
info "Checking Laravel installation..."
if [ -f "artisan" ]; then
    info "✓ Laravel artisan found"
else
    error "✗ Laravel artisan not found"
    exit 1
fi

section "2. File Permissions Setup"
info "Setting proper file permissions..."

# Set file permissions (644 for files, 755 for directories)
find . -type f -name "*.php" -exec chmod 644 {} \;
find . -type f -name "*.js" -exec chmod 644 {} \;
find . -type f -name "*.css" -exec chmod 644 {} \;
find . -type f -name "*.html" -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Special permissions for Laravel
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chmod 644 .env
chmod +x artisan

info "✓ Permissions set successfully"

section "3. Composer Dependencies"
# Check for composer
if command -v composer &> /dev/null; then
    info "Composer found, installing dependencies..."
    composer install --optimize-autoloader --no-dev --ignore-platform-reqs
    
    if [ $? -eq 0 ]; then
        info "✓ Composer dependencies installed successfully"
    else
        warn "Composer install failed, trying with increased memory..."
        php -d memory_limit=512M $(which composer) install --optimize-autoloader --no-dev --ignore-platform-reqs
    fi
elif [ -f "composer.phar" ]; then
    info "Using local composer.phar..."
    php composer.phar install --optimize-autoloader --no-dev --ignore-platform-reqs
else
    warn "Composer not found, downloading..."
    curl -sS https://getcomposer.org/installer | php
    if [ -f "composer.phar" ]; then
        php composer.phar install --optimize-autoloader --no-dev --ignore-platform-reqs
        info "✓ Composer installed and dependencies loaded"
    else
        error "Failed to download composer"
        exit 1
    fi
fi

section "4. Laravel Configuration"
info "Setting up Laravel configuration..."

# Generate app key if not present
if ! grep -q "APP_KEY=base64:" .env; then
    info "Generating application key..."
    php artisan key:generate --force
    info "✓ Application key generated"
else
    info "✓ Application key already exists"
fi

# Clear all caches
info "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache configurations for production
info "Caching configurations for production..."
php artisan config:cache
php artisan view:cache

# Only cache routes if no closures in routes
info "Attempting to cache routes..."
php artisan route:cache 2>/dev/null || {
    warn "Route caching failed (probably due to closures in routes)"
    warn "This is normal and won't affect functionality"
}

info "✓ Laravel configuration completed"

section "5. Storage Setup"
# Create storage link if it doesn't exist
if [ ! -L "public/storage" ] && [ ! -d "public/storage" ]; then
    info "Creating storage symlink..."
    php artisan storage:link
    if [ $? -eq 0 ]; then
        info "✓ Storage symlink created successfully"
    else
        warn "Failed to create storage symlink automatically"
        warn "You may need to create it manually or check permissions"
    fi
else
    info "✓ Storage symlink already exists"
fi

# Ensure storage directories exist
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

info "✓ Storage directories verified"

section "6. Database Setup"
echo
read -p "Do you want to run database migrations now? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    info "Running database migrations..."
    php artisan migrate --force
    
    if [ $? -eq 0 ]; then
        info "✓ Database migrations completed successfully"
        
        echo
        read -p "Do you want to seed the database with sample data? (y/n): " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            info "Seeding database..."
            php artisan db:seed --force
            if [ $? -eq 0 ]; then
                info "✓ Database seeded successfully"
            else
                warn "Database seeding failed, but this is not critical"
            fi
        fi
    else
        error "Database migration failed!"
        error "Please check your database configuration in .env file"
    fi
else
    warn "Skipping database migrations"
    warn "Remember to run 'php artisan migrate --force' later"
fi

section "7. Final Optimization"
info "Running final optimizations..."

# Laravel optimize command
php artisan optimize

info "✓ Optimization completed"

section "8. Verification"
info "Verifying installation..."

# Check if key directories exist and are writable
if [ -w "storage" ] && [ -w "bootstrap/cache" ]; then
    info "✓ Required directories are writable"
else
    warn "Some directories may not be writable"
fi

# Check if .env exists
if [ -f ".env" ]; then
    info "✓ Environment file exists"
else
    error "✗ Environment file missing"
fi

echo
echo "============================================"
info "DEPLOYMENT COMPLETED!"
echo "============================================"
echo
section "IMPORTANT NEXT STEPS:"
echo "1. 🔧 Update your .env file with correct database credentials"
echo "2. 🌐 Ensure your domain points to this directory"
echo "3. 🔒 Install SSL certificate for HTTPS"
echo "4. 📧 Configure email settings in .env if needed"
echo "5. 🔄 Set up cron jobs for scheduled tasks (if any)"
echo "6. 🛡️  Configure firewall and security settings"
echo
section "VERIFICATION CHECKLIST:"
echo "□ Website loads without errors"
echo "□ Database connection works"
echo "□ File uploads work (if applicable)"
echo "□ Email notifications work (if configured)"
echo "□ SSL certificate is active"
echo "□ All forms and features work properly"
echo
section "TROUBLESHOOTING:"
echo "• If you see 500 errors, check: storage/logs/laravel.log"
echo "• For permission issues, run: chmod -R 775 storage bootstrap/cache"
echo "• For composer issues, try: php -d memory_limit=512M composer.phar install"
echo
info "Deployment log saved to: deployment-$(date +%Y%m%d-%H%M%S).log"

# Save deployment info
cat << EOF > "deployment-$(date +%Y%m%d-%H%M%S).log"
Portal Desa Deployment Log
Date: $(date)
PHP Version: $(php -r "echo PHP_VERSION;")
Laravel Version: $(php artisan --version 2>/dev/null || echo "Unknown")
Directory: $(pwd)
User: $(whoami)
EOF

echo
info "🎉 Portal Desa deployment completed successfully!"
info "Visit your website to verify everything works correctly."
echo
