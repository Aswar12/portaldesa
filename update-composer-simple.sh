#!/bin/bash

# Simple Composer 2 upgrade script
echo "==============================================="
echo "UPGRADING COMPOSER TO VERSION 2"
echo "==============================================="

# Show current version
echo "Current Composer version:"
composer --version

echo ""
echo "Step 1: Downloading latest Composer 2..."

# Method 1: Try self-update first (may work on some servers)
echo "Trying composer self-update..."
composer self-update --2 2>/dev/null

# Check if it worked
NEW_VERSION=$(composer --version 2>/dev/null | grep -o "Composer version [0-9]\+\.[0-9]\+\.[0-9]\+" | grep -o "[0-9]\+\.[0-9]\+\.[0-9]\+")
MAJOR_VERSION=$(echo $NEW_VERSION | cut -d. -f1)

if [ "$MAJOR_VERSION" = "2" ]; then
    echo "✅ Composer successfully updated to version 2!"
    composer --version
else
    echo "⚠️ Self-update failed. Trying manual installation..."
    
    # Method 2: Download and install manually
    echo "Step 2: Manual installation..."
    
    # Download installer
    curl -sS https://getcomposer.org/installer | php
    
    # Try to replace system composer (if we have permission)
    if [ -w "$(which composer)" ]; then
        echo "Replacing system composer..."
        sudo mv composer.phar $(which composer)
        echo "✅ System composer updated!"
    else
        echo "Installing as local composer2..."
        mv composer.phar composer2
        chmod +x composer2
        echo "✅ Local composer2 created!"
        echo "Use: ./composer2 instead of composer"
    fi
fi

echo ""
echo "Step 3: Verifying installation..."

# Check final version
if [ -f "./composer2" ]; then
    echo "Local Composer version:"
    ./composer2 --version
    COMPOSER_CMD="./composer2"
else
    echo "System Composer version:"
    composer --version
    COMPOSER_CMD="composer"
fi

echo ""
echo "Step 4: Installing project dependencies..."
$COMPOSER_CMD install --no-dev --optimize-autoloader

echo ""
echo "==============================================="
echo "✅ COMPOSER UPGRADE COMPLETED!"
echo "==============================================="
