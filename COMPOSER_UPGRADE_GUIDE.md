# PANDUAN MENGATASI COMPOSER VERSION ERROR

## Masalah
Server menggunakan Composer 1.10.26, sedangkan Laravel 10 memerlukan Composer 2.x

## SOLUSI 1: Upgrade Composer (Jika punya akses sudo/root)

### Upload dan jalankan script:
```bash
# Upload file upgrade-composer-server.sh ke server
scp upgrade-composer-server.sh u818788320@id-dci-web1409:~/portaldesa/

# Login ke server dan jalankan
ssh u818788320@id-dci-web1409
cd portaldesa
chmod +x upgrade-composer-server.sh
sudo ./upgrade-composer-server.sh
```

## SOLUSI 2: Install Composer 2 Lokal (Shared Hosting)

### Jika tidak punya akses root:
```bash
# Upload script
scp setup-composer2-local.sh u818788320@id-dci-web1409:~/portaldesa/

# Login dan jalankan
ssh u818788320@id-dci-web1409
cd portaldesa
chmod +x setup-composer2-local.sh
./setup-composer2-local.sh
```

### Atau manual:
```bash
# Download Composer 2 ke direktori project
curl -sS https://getcomposer.org/installer | php -- --filename=composer2
chmod +x composer2

# Gunakan composer lokal
./composer2 install --no-dev --optimize-autoloader
```

## SOLUSI 3: Downgrade Laravel ke versi 9 (Kompatibel dengan Composer 1)

### Backup composer.json lama:
```bash
cp composer.json composer-laravel10.json
```

### Ganti dengan versi kompatibel:
```bash
# Upload composer-fallback.json ke server
scp composer-fallback.json u818788320@id-dci-web1409:~/portaldesa/

# Rename dan install
ssh u818788320@id-dci-web1409
cd portaldesa
mv composer.json composer-laravel10.json
mv composer-fallback.json composer.json
composer install --no-dev --optimize-autoloader
```

## SOLUSI 4: Manual Download Vendor (Emergency)

### Jika semua gagal, download vendor dari local:
```bash
# Di local (Windows)
composer install --no-dev --optimize-autoloader

# Upload vendor folder ke server
scp -r vendor/ u818788320@id-dci-web1409:~/portaldesa/
```

## REKOMENDASI

1. **Coba SOLUSI 2** terlebih dahulu (install Composer 2 lokal)
2. Jika gagal, gunakan **SOLUSI 3** (downgrade ke Laravel 9)
3. **SOLUSI 1** hanya jika punya akses root
4. **SOLUSI 4** sebagai emergency backup

## VERIFIKASI

Setelah berhasil install:
```bash
# Cek autoload
php artisan --version

# Generate key jika belum ada
php artisan key:generate

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
