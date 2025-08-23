# Panduan Deployment Portal Desa ke Hostinger

## Informasi Domain & Database

- **Domain:** kadunjaya.kampungku.online
- **Database Host:** localhost
- **Database Name:** u818788320_portaldesa
- **Database User:** u818788320_portaldesa
- **Database Password:** Sumarlin120101!

## Persiapan Sebelum Upload

### 1. Persiapan File
- Pastikan semua file sudah terupdate
- File `.env.production` sudah disiapkan dengan konfigurasi production
- Script `deploy-hostinger.sh` sudah tersedia

### 2. Kompresi Project
```bash
# Buat archive tanpa folder tidak penting
tar --exclude='node_modules' --exclude='.git' --exclude='vendor' -czf portaldesa.tar.gz .
```

## Langkah-langkah Deployment di Hostinger

### 1. Login ke SSH Hostinger
```bash
ssh username@yourdomain.com -p 65002
# atau
ssh username@serverip -p 65002
```

### 2. Navigasi ke Directory Web
```bash
cd public_html
# atau untuk subdomain
cd domains/yourdomain.com/public_html
```

### 3. Upload dan Extract Project
```bash
# Upload file portaldesa.tar.gz menggunakan FileManager atau SCP
# Kemudian extract:
tar -xzf portaldesa.tar.gz

# Atau jika upload manual, pastikan semua file Laravel ada di root directory
```

### 4. Set Environment File
```bash
# Copy file environment untuk production
cp .env.production .env

# Edit file .env dengan nano atau vi
nano .env
```

### 5. Update Konfigurasi Database di .env
```
DB_HOST=localhost
DB_DATABASE=u818788320_portaldesa
DB_USERNAME=u818788320_portaldesa
DB_PASSWORD=Sumarlin120101!
```

### 6. Jalankan Script Deployment
```bash
chmod +x deploy-hostinger.sh
./deploy-hostinger.sh
```

### 7. Install Composer Dependencies (Manual jika diperlukan)
```bash
# Jika composer tersedia di sistem
composer install --optimize-autoloader --no-dev

# Jika tidak tersedia, download composer terlebih dahulu
curl -sS https://getcomposer.org/installer | php
php composer.phar install --optimize-autoloader --no-dev
```

### 8. Setup Database
```bash
# Jalankan migrasi database
php artisan migrate --force

# (Opsional) Seed data awal
php artisan db:seed --force
```

### 9. Optimisasi untuk Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## Konfigurasi Domain

### 1. Untuk Domain Utama
- File Laravel sudah ada di `public_html/`
- `.htaccess` akan handle redirect ke folder `public`
- **Akses website di:** https://kadunjaya.kampungku.online

### 2. Untuk Subdomain
- Buat subdomain di cPanel
- Upload file ke folder subdomain
- Pastikan document root mengarah ke folder yang benar

## Troubleshooting Common Issues

### 1. Permission Errors
```bash
chmod -R 755 storage bootstrap/cache
chown -R username:username storage bootstrap/cache
```

### 2. Composer Memory Limit
```bash
php -d memory_limit=512M composer.phar install --optimize-autoloader --no-dev
```

### 3. Database Connection Error
- Pastikan credentials database benar di `.env`
- Cek apakah database sudah dibuat di cPanel
- Cek hostname database (biasanya `localhost`)

### 4. 500 Internal Server Error
```bash
# Cek error logs
tail -f storage/logs/laravel.log

# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Post-Deployment Checklist

- [ ] Website dapat diakses tanpa error
- [ ] Database terhubung dengan benar
- [ ] File upload berfungsi (storage symlink)
- [ ] Email notifications berfungsi
- [ ] SSL certificate terpasang
- [ ] Backup database dan files
- [ ] Setup monitoring dan logging

## Maintenance Commands

### Update Project
```bash
# Backup database terlebih dahulu
php artisan backup:run

# Update composer dependencies
composer update --optimize-autoloader --no-dev

# Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Regular Maintenance
```bash
# Clean up log files
php artisan log:clear

# Optimize database
php artisan migrate:status
php artisan queue:work --daemon
```

## Security Considerations

1. **File Permissions**: Pastikan folder `storage` dan `bootstrap/cache` writable
2. **Environment File**: Jangan pernah commit file `.env` ke version control
3. **Debug Mode**: Set `APP_DEBUG=false` di production
4. **SSL**: Selalu gunakan HTTPS di production
5. **Database**: Gunakan user database dengan privilege minimal

## Backup Strategy

1. **Database Backup**:
   ```bash
   mysqldump -u username -p database_name > backup.sql
   ```

2. **Files Backup**:
   ```bash
   tar -czf backup-$(date +%Y%m%d).tar.gz .
   ```

3. **Automated Backup**: Setup cron job untuk backup otomatis

## Contact & Support

Jika mengalami masalah:
1. Cek log file di `storage/logs/laravel.log`
2. Cek error log hosting di cPanel
3. Dokumentasi Laravel: https://laravel.com/docs
