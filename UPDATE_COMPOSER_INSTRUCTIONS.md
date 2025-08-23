# INSTRUKSI UPDATE COMPOSER DI SERVER

## Upload Script ke Server
```bash
scp update-composer-simple.sh u818788320@id-dci-web1409:~/portaldesa/
```

## Login dan Jalankan
```bash
ssh u818788320@id-dci-web1409
cd portaldesa
chmod +x update-composer-simple.sh
./update-composer-simple.sh
```

## Manual Alternative (jika script gagal)
```bash
# Login ke server
ssh u818788320@id-dci-web1409
cd portaldesa

# Method 1: Try self-update
composer self-update --2

# Method 2: Manual download (jika method 1 gagal)
curl -sS https://getcomposer.org/installer | php
mv composer.phar composer2
chmod +x composer2

# Install dependencies
./composer2 install --no-dev --optimize-autoloader
```

## Verifikasi
```bash
# Cek versi
composer --version
# atau jika menggunakan composer2 lokal:
./composer2 --version

# Test Laravel
php artisan --version
```

## Jika Berhasil
Script akan otomatis menjalankan `composer install` setelah upgrade berhasil.

## Troubleshooting
- Jika tidak ada akses sudo: Script akan membuat `composer2` lokal
- Gunakan `./composer2` untuk perintah composer selanjutnya
- Jika curl tidak tersedia, gunakan wget atau download manual
