-- ===============================================
-- CLEAN BACKUP - Portal Desa Database
-- Generated: 2025-08-31 17:08:30
-- Database: DESA-LARAVEL
-- Fixed APBDes with tampil_infografis field
-- ===============================================

SET NAMES utf8mb4;

SET FOREIGN_KEY_CHECKS = 0;

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

SET time_zone = '+00:00';

-- ===============================================
-- Table structure for table `anggarans`
-- ===============================================

DROP TABLE IF EXISTS `anggarans`;

CREATE TABLE `anggarans` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belanja',
    `jumlah` decimal(15, 2) NOT NULL DEFAULT '0.00',
    `realisasi` decimal(15, 2) NOT NULL DEFAULT '0.00',
    `tahun_anggaran` year NOT NULL DEFAULT '2025',
    `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `deskripsi` text COLLATE utf8mb4_unicode_ci,
    `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` bigint unsigned NOT NULL,
    `tampil_infografis` tinyint(1) NOT NULL DEFAULT '0',
    `warna_chart` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#17a2b8',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 15 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ===============================================
-- Dumping data for table `anggarans`
-- ===============================================

LOCK TABLES `anggarans` WRITE;

INSERT INTO
    `anggarans`
VALUES (
        1,
        'Rincian Dana Desa 2024',
        'rincian-dana-desa',
        '<p>Contoh saja</p>',
        'belanja',
        100000000.00,
        80000000.00,
        2025,
        NULL,
        NULL,
        'img-anggaran//67aaf242796a8.jpeg',
        1,
        1,
        '#17a2b8',
        '2025-02-11 06:46:26',
        '2025-08-31 09:08:30'
    ),
    (
        2,
        'Rincian 2025',
        'rincian-2025',
        '<p>Contoh Saja</p>',
        'belanja',
        100000000.00,
        80000000.00,
        2025,
        NULL,
        NULL,
        'img-anggaran//67aaf2a551c24.png',
        1,
        1,
        '#17a2b8',
        '2025-02-11 06:48:05',
        '2025-08-31 09:08:30'
    );

UNLOCK TABLES;

-- ===============================================
-- Table structure for table `migrations`
-- ===============================================

-- Add the new migration record
INSERT IGNORE INTO
    `migrations` (`migration`, `batch`)
VALUES (
        '2025_08_31_141722_add_tampil_infografis_to_anggarans_table',
        20
    );

-- ===============================================
-- SQL commands to fix existing production server
-- ===============================================

/*
-- Run these commands on production server if needed:

-- 1. Check if columns exist
SHOW COLUMNS FROM anggarans LIKE 'tampil_infografis';
SHOW COLUMNS FROM anggarans LIKE 'warna_chart';

-- 2. Add columns if they don't exist
ALTER TABLE anggarans 
ADD COLUMN tampil_infografis TINYINT(1) NOT NULL DEFAULT 0 AFTER user_id,
ADD COLUMN warna_chart VARCHAR(7) NOT NULL DEFAULT '#17a2b8' AFTER tampil_infografis;

-- 3. Update existing data
UPDATE anggarans SET tampil_infografis = 1 WHERE tampil_infografis = 0;

-- 4. Add migration record
INSERT IGNORE INTO migrations (migration, batch) 
VALUES ('2025_08_31_141722_add_tampil_infografis_to_anggarans_table', 
(SELECT MAX(batch) + 1 FROM (SELECT batch FROM migrations) AS temp));
*/

SET FOREIGN_KEY_CHECKS = 1;