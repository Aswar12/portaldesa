# 🚀 Complete Deployment Guide - Fix Database Connection

## 🎯 **Quick Fix Summary:**
Error: `SQLSTATE[HY000] [1045] Access denied for user 'u818788320_portaldesa'`

**Root Cause**: Database belum dikonfigurasi dengan benar di server hosting

## 📋 **Step-by-Step Fix:**

### **STEP 1: Setup Database di cPanel**
1. **Login ke cPanel** hosting
2. **MySQL Databases** → Create New Database
   - Database Name: `portaldesa` (akan menjadi `u818788320_portaldesa`)
3. **Create MySQL User**
   - Username: `portaldesa` (akan menjadi `u818788320_portaldesa`)
   - Password: [buat password kuat, catat!]
4. **Add User to Database**
   - User: `u818788320_portaldesa`
   - Database: `u818788320_portaldesa`
   - Privileges: **ALL PRIVILEGES**

### **STEP 2: Upload Test Files**
Upload files berikut ke root directory website:
- ✅ `check-database-connection.php`
- ✅ `setup-default-situses.php`
- ✅ `AppServiceProvider.php` (yang sudah diperbaiki)

### **STEP 3: Test Database Connection**
1. **Akses**: `https://kadunjaya.kampungku.online/check-database-connection.php`
2. **Lihat hasil test** - akan menampilkan konfigurasi yang benar
3. **Catat konfigurasi** yang berhasil connect

### **STEP 4: Update File .env**
1. **Edit .env** di server hosting
2. **Update dengan konfigurasi yang benar**:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u818788320_portaldesa
DB_USERNAME=u818788320_portaldesa
DB_PASSWORD=your_actual_password
```

### **STEP 5: Import Database**
**Option A - Via phpMyAdmin:**
1. Login phpMyAdmin
2. Select database: `u818788320_portaldesa`
3. Import: `BACKUP-READY-FOR-PHPMYADMIN-CLEAN.sql`

**Option B - Via SQL Query:**
```sql
-- Create situses table if not exists
CREATE TABLE IF NOT EXISTS `situses` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nm_desa` varchar(255) NOT NULL,
    `alamat` text,
    `telp` varchar(255),
    `email` varchar(255),
    `website` varchar(255),
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

-- Insert default data
INSERT INTO `situses` (nm_desa, alamat, telp, email, website, created_at, updated_at) 
VALUES ('Kadun Jaya', 'Alamat Desa Kadun Jaya', '021-xxx-xxxx', 'admin@kadunjaya.kampungku.online', 'https://kadunjaya.kampungku.online', NOW(), NOW());
```

## ✅ **Files Ready to Upload:**
1. `check-database-connection.php` - Test database
2. `setup-default-situses.php` - Setup default data
3. `AppServiceProvider.php` - Fixed provider
4. `BACKUP-READY-FOR-PHPMYADMIN-CLEAN.sql` - Clean database
5. `.env.hosting-template` - Environment template

**Upload semua files ini dan ikuti step-by-step guide di atas!**
