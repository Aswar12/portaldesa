#!/bin/bash

# Script untuk menggunakan Composer 2 di shared hosting tanpa root access
echo "==================================="
echo "COMPOSER 2 SETUP FOR SHARED HOSTING"
echo "==================================="

# Cek versi saat ini
echo "Current system Composer version:"
composer --version

echo ""
echo "Downloading Composer 2 to local directory..."

# Download Composer 2 ke direktori lokal
cd ~/portaldesa
curl -sS https://getcomposer.org/installer | php -- --filename=composer2

# Buat alias atau script untuk menggunakan Composer 2
echo "Creating local Composer 2..."
chmod +x composer2

echo ""
echo "Using local Composer 2:"
./composer2 --version

echo ""
echo "Installing dependencies with Composer 2..."
./composer2 install --no-dev --optimize-autoloader

echo "Setup completed!"
