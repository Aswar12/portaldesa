#!/bin/bash

# Script untuk upgrade Composer dari versi 1 ke versi 2
echo "==================================="
echo "COMPOSER UPGRADE SCRIPT"
echo "==================================="

# Cek versi saat ini
echo "Current Composer version:"
composer --version

echo ""
echo "Downloading Composer 2..."

# Download Composer 2 terbaru
EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

# Install Composer 2 dengan self-update jika ada akses
if command -v sudo >/dev/null 2>&1; then
    echo "Installing with sudo access..."
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
else
    echo "Installing locally (no sudo access)..."
    # Install ke direktori lokal
    php composer-setup.php --install-dir=. --filename=composer2
    chmod +x composer2
    
    # Buat alias untuk composer
    echo "Creating local composer alias..."
    echo '#!/bin/bash' > composer
    echo 'php "$( dirname "${BASH_SOURCE[0]}" )"/composer2.phar "$@"' >> composer
    chmod +x composer
fi

# Cleanup
rm composer-setup.php

echo ""
echo "Composer upgrade completed!"

# Cek versi baru
if [ -f "./composer2" ]; then
    echo "Local Composer 2 version:"
    ./composer2 --version
    echo ""
    echo "Installing dependencies with Composer 2..."
    ./composer2 install --no-dev --optimize-autoloader
else
    echo "System Composer version:"
    composer --version
    echo ""
    echo "Installing dependencies..."
    composer install --no-dev --optimize-autoloader
fi

echo "Setup completed!"
