-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: DESA-LARAVEL
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agamas`
--

DROP TABLE IF EXISTS `agamas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agamas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penganut` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agamas`
--

LOCK TABLES `agamas` WRITE;
/*!40000 ALTER TABLE `agamas` DISABLE KEYS */;
INSERT INTO `agamas` VALUES (1,'Islam',100,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(2,'Kristen',30,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(3,'Katolik',20,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(4,'Hindu',10,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(5,'Budha',15,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(6,'Konghucu',6,1,'2025-02-11 03:21:45','2025-02-11 03:21:45');
/*!40000 ALTER TABLE `agamas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anggarans`
--

DROP TABLE IF EXISTS `anggarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggarans`
--

LOCK TABLES `anggarans` WRITE;
/*!40000 ALTER TABLE `anggarans` DISABLE KEYS */;
INSERT INTO `anggarans` VALUES (1,'Rincian Dana Desa 2024','rincian-dana-desa','<p>Contoh saja</p>','img-anggaran//67aaf242796a8.jpeg',1,'2025-02-11 06:46:26','2025-02-11 06:46:49'),(2,'Rincian 2025','rincian-2025','<p>Contoh Saja</p>','img-anggaran//67aaf2a551c24.png',1,'2025-02-11 06:48:05','2025-02-11 06:48:05');
/*!40000 ALTER TABLE `anggarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `excerpt` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pengumuman` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `announcements_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'Cek Kesehatan Gratis','cek-kesehatan-gratis',2,'Dinas Kesehatan Kota Bandung mengadakan Cek Kesehatan Gratis bagi seluruh warga Bandung! Manfaatkan kesempatan ini untuk mengetahui kondisi kesehatan Anda dan mendapatkan konsultasi medis secara grati...','<p>Dinas Kesehatan Kota Bandung mengadakan <strong>Cek Kesehatan Gratis</strong> bagi seluruh warga Bandung! Manfaatkan kesempatan ini untuk mengetahui kondisi kesehatan Anda dan mendapatkan konsultasi medis secara gratis.</p><p>≡ƒôà <strong>Tanggal:</strong> [Isi tanggal kegiatan]<br>≡ƒòÿ <strong>Waktu:</strong> [Isi waktu kegiatan]<br>≡ƒôì <strong>Lokasi:</strong> [Isi lokasi kegiatan]</p><p>≡ƒöì <strong>Layanan yang tersedia:</strong><br>Γ£à Pemeriksaan tekanan darah<br>Γ£à Cek gula darah<br>Γ£à Pemeriksaan kolesterol<br>Γ£à Konsultasi kesehatan dengan dokter<br>Γ£à Edukasi pola hidup sehat</p><p>≡ƒÆí <strong>Syarat &amp; Ketentuan:</strong><br>≡ƒôî Warga Kota Bandung (bawa KTP/KK)<br>≡ƒôî Datang sesuai jadwal dan tetap menjaga protokol kesehatan</p><p>Jangan lewatkan kesempatan ini! Ajak keluarga dan kerabat untuk bersama-sama menjaga kesehatan.</p><p>≡ƒô₧ <strong>Informasi lebih lanjut:</strong> [Isi kontak atau link resmi]</p><p>Salam sehat,<br><strong>Dinas Kesehatan Kota Bandung</strong></p>',1,'2025-02-11 06:42:52','2025-02-11 06:44:30'),(2,'PROGRAM BANTUAN DAN PELATIHAN UNTUK UMKM KOTA BANDUNG','program-bantuan-dan-pelatihan-untuk-umkm-kota-bandung',0,'Pemerintah Kota Bandung melalui Dinas Koperasi dan UMKM mengadakan program bantuan dan pelatihan bagi para pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) untuk meningkatkan daya saing dan memperluas p...','<p>Pemerintah Kota Bandung melalui Dinas Koperasi dan UMKM mengadakan <strong>program bantuan dan pelatihan</strong> bagi para pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) untuk meningkatkan daya saing dan memperluas pasar!</p><p>≡ƒôà <strong>Tanggal Pendaftaran:</strong> [Isi tanggal]<br>≡ƒôì <strong>Lokasi:</strong> [Isi lokasi atau link pendaftaran]</p><p>≡ƒöì <strong>Fasilitas yang diberikan:</strong><br>Γ£à Bantuan modal usaha<br>Γ£à Pelatihan digital marketing dan branding<br>Γ£à Pendampingan legalitas usaha (NIB, PIRT, Halal, dll.)<br>Γ£à Akses ke marketplace dan jaringan bisnis</p><p>≡ƒÆí <strong>Syarat &amp; Ketentuan:</strong><br>≡ƒôî Pelaku UMKM yang berdomisili di Kota Bandung<br>≡ƒôî Memiliki usaha yang sudah berjalan minimal 6 bulan<br>≡ƒôî Bersedia mengikuti seluruh rangkaian pelatihan</p><p>≡ƒô₧ <strong>Informasi lebih lanjut:</strong> [Isi kontak atau link resmi]</p><p>Jangan lewatkan kesempatan ini untuk mengembangkan usaha Anda!</p><p>Salam sukses,<br><strong>Dinas Koperasi dan UMKM Kota Bandung</strong></p>',1,'2025-02-11 06:43:42','2025-02-11 06:43:42'),(3,'LOMBA UMKM INOVATIF KOTA BANDUNG 2025','lomba-umkm-inovatif-kota-bandung-2025',1,'Pemerintah Kota Bandung melalui Dinas Koperasi dan UMKM mengundang para pelaku usaha mikro, kecil, dan menengah (UMKM) untuk mengikuti Lomba UMKM Inovatif 2025! Tunjukkan kreativitas dan inovasi usaha...','<p>Pemerintah Kota Bandung melalui <strong>Dinas Koperasi dan UMKM</strong> mengundang para pelaku usaha mikro, kecil, dan menengah (UMKM) untuk mengikuti <strong>Lomba UMKM Inovatif 2025</strong>! Tunjukkan kreativitas dan inovasi usaha Anda serta raih hadiah menarik!</p><p>≡ƒôà <strong>Pendaftaran:</strong> [Isi tanggal pendaftaran]<br>≡ƒôà <strong>Batas Akhir Pendaftaran:</strong> [Isi batas waktu]<br>≡ƒôì <strong>Lokasi Acara:</strong> [Isi lokasi acara]</p><p>≡ƒöì <strong>Kategori Lomba:</strong><br>≡ƒÅå UMKM Kuliner<br>≡ƒÅå UMKM Fashion &amp; Kerajinan<br>≡ƒÅå UMKM Teknologi &amp; Jasa</p><p>≡ƒÄü <strong>Hadiah:</strong><br>≡ƒÅà Juara 1: Rp [Isi nominal] + Sertifikat + Pembinaan Eksklusif<br>≡ƒÑê Juara 2: Rp [Isi nominal] + Sertifikat<br>≡ƒÑë Juara 3: Rp [Isi nominal] + Sertifikat</p><p>≡ƒÆí <strong>Syarat &amp; Ketentuan:</strong><br>≡ƒôî UMKM berdomisili di Kota Bandung<br>≡ƒôî Usaha sudah berjalan minimal 6 bulan<br>≡ƒôî Mengisi formulir pendaftaran dan mengunggah profil usaha</p><p>≡ƒô₧ <strong>Informasi &amp; Pendaftaran:</strong> [Isi kontak/link pendaftaran]</p><p>Jangan lewatkan kesempatan ini! Tunjukkan inovasi terbaik dan jadilah UMKM unggulan Kota Bandung! ≡ƒÜÇ</p><p><strong>Dinas Koperasi dan UMKM Kota Bandung</strong></p>',1,'2025-02-11 06:44:26','2025-02-11 06:44:34');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beritas`
--

DROP TABLE IF EXISTS `beritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beritas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status_id` bigint unsigned NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beritas`
--

LOCK TABLES `beritas` WRITE;
/*!40000 ALTER TABLE `beritas` DISABLE KEYS */;
INSERT INTO `beritas` VALUES (1,'img-berita//687079de1f328.jpg','377 Kepala Keluarga Kampung Kadun Jaya Terima BLT Dana Desa Tahap Akhir Tahun 2021','Timika, fajarpapua.com ΓÇô Pemerintah Kampung Kadun Jaya, Distrik Mimika Timur menyalurkan Bantuan Lan...','377-kepala-keluarga-kampung-kadun-jaya-terima-blt-dana-desa-tahap-akhir-tahun-2021',1,'<p><strong>Timika, fajarpapua.com</strong> ΓÇô Pemerintah Kampung Kadun Jaya, Distrik Mimika Timur menyalurkan Bantuan Langsung Tunai (BLT) Dana Desa tahap akhir Tahun 2021.</p><p>BLT yang bersumber dari dana desa Kampung Kadun Jaya tersebut disalurkan kepada 377 kepala keluarga dengan besaran Rp 900 ribu per triwulan.</p><p>Kepala Kampung Kadun Jaya, Elias Yawa saat ditemui fajarpapua.com, Kamis (23/12) mengatakan pihaknya telah melakukan pembaruan data terkait penerima BLT.</p><p>Diakuinya, sebelumnya terdapat beberapa warga yang berstatus pegawai negeri sipil (PNS,) yang ikut menerima bantuan tersebut.</p><p>ΓÇ£Dari 377 KK itu kan sebelumnya ada PNS yang ikut terima, sehingga kami lakukan pembaruan data dan penerima yang berstatus PNS kami gantikan dengan warga lainnya,ΓÇ¥ ujarnya.</p><p>Besaran dana BLT yang telah dicairkan disalurkan oleh Pemerintah Kampung Kadun Jaya sebesar Rp 339.300.000 atau per kepala keluarga menerima Rp 900 ribu per tiga bulan.</p><p>ΓÇ£377 KK penerima BLT tersebar di 12 RT yang ada di Kampung Kadun Jaya, sehingga terjadi pemerataan dan dari data, para penerima sesuai standar terkait dengan kemampuan ekonominya,ΓÇ¥ tutupnya. (feb)</p><p>&nbsp;</p><p>Sumber : <a href=\"https://fajarpapua.com/2021/12/23/377-kepala-keluarga-kampung-kadun-jaya-terima-blt-dana-desa-tahap-akhir-tahun-2021/\">https://fajarpapua.com/2021/12/23/377-kepala-keluarga-kampung-kadun-jaya-terima-blt-dana-desa-tahap-akhir-tahun-2021/</a></p>',1,2,5,'2025-02-11 06:05:19','2025-07-11 09:41:34'),(2,'img-berita//6870798c785f2.jpg','Cegah Kecurangan PSU Pilkada Mimika, 328 Surat Suara Sisa TPS 01 Kadun Jaya Dimusnahkan, Banyak Pramuria Kilo 10 Ikut Coblos','Timika, fajarpapua.com ΓÇô Pemungutan Suara Ulang (PSU) Pilkada Mimika 2024 di TPS 01, Kampung Kadun J...','cegah-kecurangan-psu-pilkada-mimika-328-surat-suara-sisa-tps-01-kadun-jaya-dimusnahkan-banyak-pramuria-kilo-10-ikut-coblos',0,'<p><strong>Timika, fajarpapua.com</strong> ΓÇô Pemungutan Suara Ulang (PSU) Pilkada Mimika 2024 di TPS 01, Kampung Kadun Jaya, Distrik Wania, Kabupaten Mimika, Provinsi Papua Tengah, Sabtu (7/12/2024) berjalan lancar.</p><p>Nampak masyarakat setempat menggunakan hak pilih sesuai Daftar Pemilih Tetap (DPT) di TPS tersebut.</p><p>TPS 01 Kampung Kadun Jaya memiliki 484 DPT tetapi yang melakukan pencoblosan hanya 169 orang karena sisanya telah pindah penduduk bahkan berdomisili di tempat lain.</p><p>Adapun surat suara cadangan di TPS 01 Kadun Jaya sebanyak 13 ditambah sisa suara 315 dimusnahkan sesuai kesepakatan bersama.</p><p>Total suara sisa dimusnahkan pada TPS 01, Kampung Kadun Jaya sebanyak 328 dengan cara dicoret menggunakan spidol.</p><p>Pemusnahan surat suara sisa ini guna mencegah kecurangan yang masif terjadi selama pelaksanaan Pilkada 2024 di Mimika.</p><p>Nampak masyarakat dan saksi dari masing-masing pasangan calon bupati dan wakil bupati Mimika, calon Gubenur dan Cawagub Papua Tengah menyaksikan pemusnahan surat suara sisa tersebut.</p><p>Berdasarkan informasi dihimpun dari masyarakat yang berdomisili di Kadun Jaya bahwa sebenarnya jumlah DPT di TPS itu tidak sampai 484.</p><p>DPT di TPS 01 Kampung Kadun Jaya hanya sekitar 200 lebih karena banyak yang telah pindah domisili. Proses perhitungan perolehan suara di TPS itu akan dilakukan pada pukul 14:00 WIT.</p><p>Menariknya, banyak pramuria lokalisasi Kilometer 10 yang ikut mencoblos. ΓÇ£Mari mas, kita coblos,ΓÇ¥ ajak seorang pramuria kepada wartawan fajarpapua.com yang sedang menikmati situasi pencoblosan itu. (*)</p><p>Sumber : <a href=\"https://fajarpapua.com/2024/12/07/cegah-kecurangan-psu-pilkada-mimika-328-surat-suara-sisa-tps-01-kadun-jaya-dimusnahkan-banyak-pramuria-kilo-10-ikut-coblos/\">https://fajarpapua.com/2024/12/07/cegah-kecurangan-psu-pilkada-mimika-328-surat-suara-sisa-tps-01-kadun-jaya-dimusnahkan-banyak-pramuria-kilo-10-ikut-coblos/</a></p>',1,2,5,'2025-02-11 06:28:51','2025-07-11 09:40:12'),(3,'img-berita//6870792375d05.jpeg','Dokter Juliana Galingging Luncurkan Posyandu ILP Perdana di Kampung Kadun Jaya: Akses Layanan Kesehatan Lengkap dan Terintegrasi','Timika, fajarpapua.com -Dinas Kesehatan Kabupaten Mimika melalui Puskesmas Wania bekerja sama dengan...','dokter-juliana-galingging-luncurkan-posyandu-ilp-perdana-di-kampung-kadun-jaya-akses-layanan-kesehatan-lengkap-dan-terintegrasi-2',2,'<p><strong>Timika, fajarpapua.com -</strong>Dinas Kesehatan Kabupaten Mimika melalui Puskesmas Wania bekerja sama dengan Dinas Sosial resmi meluncurkan Posyandu Integrasi Layanan Primer (ILP) perdana di Posyandu Melati, Kampung Kadun Jaya, Distrik Wania, Senin (6/5). Kegiatan ini dipimpin dokter Juliana Galingging bersama tim medis Puskesmas Wania.</p><p>Posyandu ILP merupakan pengembangan layanan kesehatan dasar yang tidak hanya menyasar balita, tetapi juga mencakup seluruh kelompok usia, mulai dari bayi usia 0 bulan hingga lanjut usia. Konsep integratif ini diharapkan mampu menjawab kebutuhan masyarakat terhadap layanan kesehatan yang menyeluruh dan mudah diakses.</p><p>ΓÇ£Ini pertama kalinya kami menerapkan model Posyandu ILP di wilayah kerja Puskesmas Wania. Kami berharap, seluruh posyandu di kampung-kampung dan kelurahan lain bisa mengikuti langkah ini,ΓÇ¥ ujar dr. Juliana Galingging kepada media di sela kegiatan.</p><p>Dalam kegiatan tersebut, Dinas Sosial turut memberikan dukungan berupa bantuan peralatan kesehatan seperti timbangan bayi dan dewasa, alat ukur tekanan darah (tensi), alat pemeriksaan gula darah, kolesterol, asam urat, hingga Hb.</p><p>ΓÇ£Bantuan dari Dinas Sosial sangat membantu. Masyarakat jadi antusias karena bisa mendapatkan pemeriksaan kesehatan yang lengkap dan gratis,ΓÇ¥ tambah dr. Juliana.</p><p>Ia juga menyampaikan harapannya agar kolaborasi lintas sektor ini dapat terus berlanjut dan ditingkatkan di masa mendatang.</p><p>ΓÇ£Kami berharap ke depannya bantuan berupa alat pemeriksaan maupun multivitamin bisa ditambah lagi, agar pelayanan yang diberikan kepada masyarakat semakin maksimal,ΓÇ¥ ungkapnya.</p><p>Peluncuran Posyandu ILP ini disambut antusias oleh masyarakat setempat yang datang memeriksakan kondisi kesehatannya. Kegiatan ini menjadi bukti nyata komitmen tenaga kesehatan, khususnya Puskesmas Wania, dalam menghadirkan layanan yang lebih inklusif dan terjangkau bagi seluruh lapisan masyarakat.(isa)</p><p>Sumber : <a href=\"https://fajarpapua.com/2025/05/08/dokter-juliana-galingging-luncurkan-posyandu-ilp-perdana-di-kampung-kadun-jaya-akses-layanan-kesehatan-lengkap-dan-terintegrasi/\">https://fajarpapua.com/2025/05/08/dokter-juliana-galingging-luncurkan-posyandu-ilp-perdana-di-kampung-kadun-jaya-akses-layanan-kesehatan-lengkap-dan-terintegrasi/</a></p>',1,2,6,'2025-02-11 06:30:02','2025-07-11 09:39:14');
/*!40000 ALTER TABLE `beritas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_replies`
--

DROP TABLE IF EXISTS `comment_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_replies`
--

LOCK TABLES `comment_replies` WRITE;
/*!40000 ALTER TABLE `comment_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berita_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'img-gallery//67aaef79b6621.png','Curug Maribaya',1,'2025-02-11 06:34:33','2025-02-11 06:34:33'),(2,'img-gallery//67aaefacd6011.jpg','Trans Studio Bandung',1,'2025-02-11 06:35:24','2025-02-11 06:35:24'),(3,'img-gallery//67aaefdfe2f64.jpg','Ciwidey',1,'2025-02-11 06:36:15','2025-02-11 06:36:15'),(4,'img-gallery//67aaf008c7fdf.jpg','Jendela ALam',1,'2025-02-11 06:36:56','2025-02-11 06:36:56'),(5,'img-gallery//67aaf05fec26e.jpeg','De\'Ranch Lembang',1,'2025-02-11 06:38:24','2025-02-11 06:38:24'),(6,'img-gallery//67aaf09270080.jpeg','Lugs Gravitiy',1,'2025-02-11 06:39:14','2025-02-11 06:39:14'),(7,'img-gallery//67aaf0c3d5dba.jpg','Museum Geologi',1,'2025-02-11 06:40:03','2025-02-11 06:40:03'),(8,'img-gallery//67aaf0eaa93ce.jpg','Wisata Bandros',1,'2025-02-11 06:40:42','2025-02-11 06:40:42');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_kelamins`
--

DROP TABLE IF EXISTS `jenis_kelamins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_kelamins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_kelamins`
--

LOCK TABLES `jenis_kelamins` WRITE;
/*!40000 ALTER TABLE `jenis_kelamins` DISABLE KEYS */;
INSERT INTO `jenis_kelamins` VALUES (1,'Laki-laki',70,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(2,'Perempuan',55,1,'2025-02-11 03:21:45','2025-02-11 03:21:45');
/*!40000 ALTER TABLE `jenis_kelamins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategoris`
--

DROP TABLE IF EXISTS `kategoris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoris`
--

LOCK TABLES `kategoris` WRITE;
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` VALUES (1,'Teknologi','teknologi',1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(2,'Kesenian','kesenian',1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(3,'UMKM','umkm',1,'2025-02-11 06:05:44','2025-02-11 06:05:44'),(4,'pariwisata','pariwisata',1,'2025-02-11 06:26:07','2025-02-11 06:26:07'),(5,'Pemerintahan','pemerintahan',1,'2025-07-11 09:05:30','2025-07-11 09:05:30'),(6,'Kesehatan','kesehatan',1,'2025-07-11 09:05:51','2025-07-11 09:05:51');
/*!40000 ALTER TABLE `kategoris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontaks`
--

DROP TABLE IF EXISTS `kontaks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontaks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontaks`
--

LOCK TABLES `kontaks` WRITE;
/*!40000 ALTER TABLE `kontaks` DISABLE KEYS */;
INSERT INTO `kontaks` VALUES (1,'Cibuni, Bandung.','asepsyaputra840@gmail.com','0882260686031',1,'2025-02-11 03:21:45','2025-02-11 07:00:46');
/*!40000 ALTER TABLE `kontaks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layanans`
--

DROP TABLE IF EXISTS `layanans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `layanans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persyaratan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layanans`
--

LOCK TABLES `layanans` WRITE;
/*!40000 ALTER TABLE `layanans` DISABLE KEYS */;
INSERT INTO `layanans` VALUES (1,'Program UHC di Kota Bandung','<p><strong>Identitas Resmi:</strong> Memiliki identitas yang dikeluarkan oleh Pemerintah Kota Bandung selama lebih dari 1 tahun.</p><p><strong>Kartu Keluarga (KK):</strong> Bagi bayi yang usianya lebih dari 1 bulan, namanya harus sudah tercantum di Kartu Keluarga untuk bisa masuk dalam UHC.</p><p><strong>Dokumen Pendukung:</strong> Menyiapkan KTP, KK, dan hasil pemeriksaan pasien/rujukan/surat rawat.</p><p><strong>Kepesertaan JKN:</strong> UHC berlaku untuk:</p><ul><li>Pasien yang belum memiliki JKN atau PBI non-aktif (sesuai persyaratan).</li><li>Pasien terdaftar BPJS Mandiri non-aktif karena masalah premi (dengan tambahan formulir PYDOPD).</li><li>Pasien terdaftar BPJS pegawai swasta non-aktif (dengan tambahan surat keterangan kerja).</li><li>Pasien BBL (bayi dari ibu yang terdaftar PBI dengan usia &lt;28 hari) dengan tambahan Surat Keterangan Lahir.</li></ul>',1,'2025-02-11 06:23:03','2025-02-11 06:23:03'),(2,'Pendaftaran Layanan Kesehatan di Puskesmas Secara Online','<p><strong>Sistem yang Dikembangkan Sendiri oleh Puskesmas:</strong> Setiap Puskesmas mungkin memiliki sistem pendaftaran online yang unik. Petunjuk pendaftaran biasanya tersedia di situs web Puskesmas atau dapat diperoleh melalui kontak telepon.</p><p><strong>Platform Kesehatan Online Pemerintah:</strong> Jika tersedia, platform ini terintegrasi dengan beberapa Puskesmas. Anda mungkin perlu mendaftar akun terlebih dahulu sebelum dapat mendaftar di Puskesmas. Informasi lebih lanjut dapat ditemukan di situs web Dinas Kesehatan Kota Bandung.</p><p><strong>Aplikasi Pihak Ketiga:</strong> Beberapa Puskesmas mungkin bekerja sama dengan aplikasi pihak ketiga untuk menyediakan layanan pendaftaran online. Pastikan aplikasi tersebut terpercaya dan aman sebelum menggunakannya.</p><p>Langkah-langkah umum pendaftaran online di Puskesmas Bandung meliputi:</p><p><strong>Akses Situs Web atau Aplikasi:</strong> Buka situs web Puskesmas atau aplikasi yang telah ditentukan.</p><p><strong>Pendaftaran Akun:</strong> Jika diperlukan, buat akun dengan mengisi data diri yang diminta.</p><p><strong>Pilih Layanan:</strong> Pilih jenis layanan kesehatan yang dibutuhkan dan jadwal kunjungan.</p><p><strong>Konfirmasi Pendaftaran:</strong> Setelah mengisi semua informasi yang diperlukan, konfirmasi pendaftaran Anda.</p>',1,'2025-02-11 06:24:18','2025-02-11 06:24:18');
/*!40000 ALTER TABLE `layanans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_09_13_022605_create_sliders_table',1),(7,'2023_09_14_134427_create_beritas_table',1),(8,'2023_09_14_142413_create_post_statuses_table',1),(9,'2023_09_14_223318_create_kategoris_table',1),(10,'2023_09_17_091224_create_comments_table',1),(11,'2023_09_18_054320_create_comment_replies_table',1),(12,'2023_09_18_173129_create_wilayahs_table',1),(13,'2023_09_18_203110_create_sejarahs_table',1),(14,'2023_09_18_210113_create_visi_misis_table',1),(15,'2023_09_19_061945_create_perangkat_desas_table',1),(16,'2023_09_21_054915_create_agamas_table',1),(17,'2023_09_21_073255_create_jenis_kelamins_table',1),(18,'2023_09_21_085821_create_pekerjaans_table',1),(19,'2023_09_23_063218_create_petas_table',1),(20,'2023_09_24_051908_create_umkms_table',1),(21,'2023_09_25_061424_create_kontaks_table',1),(22,'2023_09_25_075226_create_video_profils_table',1),(23,'2023_09_26_054211_create_situses_table',1),(24,'2023_11_29_060538_create_layanans_table',1),(25,'2023_11_29_073753_create_galleries_table',1),(26,'2023_11_29_164313_create_announcements_table',1),(27,'2023_11_29_201150_create_anggarans_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pekerjaans`
--

DROP TABLE IF EXISTS `pekerjaans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pekerjaans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pekerjaans`
--

LOCK TABLES `pekerjaans` WRITE;
/*!40000 ALTER TABLE `pekerjaans` DISABLE KEYS */;
INSERT INTO `pekerjaans` VALUES (1,'Petani',132,1,'2025-02-11 03:21:45','2025-02-11 04:55:09'),(2,'Pegawai Negeri',14,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(3,'Belum/Tidak bekerja',10,1,'2025-02-11 03:21:45','2025-02-11 03:21:45'),(4,'Pensiunan',20,1,'2025-02-11 03:21:45','2025-02-11 03:21:45');
/*!40000 ALTER TABLE `pekerjaans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perangkat_desas`
--

DROP TABLE IF EXISTS `perangkat_desas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perangkat_desas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perangkat_desas`
--

LOCK TABLES `perangkat_desas` WRITE;
/*!40000 ALTER TABLE `perangkat_desas` DISABLE KEYS */;
INSERT INTO `perangkat_desas` VALUES (1,'Kasep Code','img-perangkat//67aaf46b5d68e.jpg','Kepala Desa',1,'2025-02-11 03:21:45','2025-02-11 06:55:39'),(2,'Zilong','img-perangkat//67aaf45773274.jpg','Sekretaris Desa',1,'2025-02-11 03:21:45','2025-02-11 06:55:19'),(3,'Qiara','img-perangkat//67aaf3cb12ce6.png','Kepala Urusan Umum',1,'2025-02-11 03:21:45','2025-02-11 06:52:59'),(4,'Julian','img-perangkat//67aaf3e13146a.jpg','Kepala Dusun',1,'2025-02-11 03:21:45','2025-02-11 06:53:21');
/*!40000 ALTER TABLE `perangkat_desas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petas`
--

DROP TABLE IF EXISTS `petas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `petas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petas`
--

LOCK TABLES `petas` WRITE;
/*!40000 ALTER TABLE `petas` DISABLE KEYS */;
INSERT INTO `petas` VALUES (1,'Peta Desa','Kampung Kadun Jaya, Diskrit Wania, Kab. MIimika',1,'2025-02-11 03:21:45','2025-07-11 09:30:29');
/*!40000 ALTER TABLE `petas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_statuses`
--

DROP TABLE IF EXISTS `post_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_statuses`
--

LOCK TABLES `post_statuses` WRITE;
/*!40000 ALTER TABLE `post_statuses` DISABLE KEYS */;
INSERT INTO `post_statuses` VALUES (1,'draft','2025-02-11 03:21:45','2025-02-11 03:21:45'),(2,'publish','2025-02-11 03:21:45','2025-02-11 03:21:45');
/*!40000 ALTER TABLE `post_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sejarahs`
--

DROP TABLE IF EXISTS `sejarahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sejarahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sejarahs`
--

LOCK TABLES `sejarahs` WRITE;
/*!40000 ALTER TABLE `sejarahs` DISABLE KEYS */;
INSERT INTO `sejarahs` VALUES (1,'Sejarah Desa Cibuni','<p>Dikutip dari buku <i>Desa Wisata Sebagai Pembangunan Ekonomi Desa </i>karya Riana Mayasari dkk., (2022) desa wisata merupakan salah satu aspek penting dalam industri pariwisata terutama di pedesaan.</p><p>Adanya desa wisata bisa mengangkat perekonomian masyarakat sekitar karena mereka menjadi memiliki alternatif pendapatan selain mengandalkan sektor pertanian dan lain sebagainya.</p><p>Salah satu desa yang disulap menjadi desa wisata daya <a href=\"https://kumparan.com/topic/desa\">Desa </a>Petani Cibuni yang ada di Jawa Barat. Ada beberapa daya tarik dari Desa Wisata Cibuni yang membuatnya direkomendasikan untuk dikunjungi.</p><h3>1. Pemandangan yang Indah</h3><p>Daya tarik utama dari kawasan wisata ini adalah pemandangannya yang indah.Desa ini terletak di kawasan kebun teh sehingga menghasilkan pemandangan hijau bak sebuah lukisan.</p><h3>2. Menyaksikan Aktivitas Bertani</h3><p>Di tempat ini wisatawan bisa menyaksikan bagaimana penduduk setempat melakukan berbagai kegiatan bertani, mulai dari mengolah lahan, perawatan hingga panen.</p>',1,'2025-02-11 03:21:45','2025-02-11 04:38:18');
/*!40000 ALTER TABLE `sejarahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situses`
--

DROP TABLE IF EXISTS `situses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `situses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situses`
--

LOCK TABLES `situses` WRITE;
/*!40000 ALTER TABLE `situses` DISABLE KEYS */;
INSERT INTO `situses` VALUES (1,'img-logo//687073289c516.png','Kampung Kadun Jaya','Diskrit Wania','Mimika','Mimika Tengah',99963,1,'2025-02-11 03:21:45','2025-07-11 09:14:21');
/*!40000 ALTER TABLE `situses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_slider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_btn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'Website Kampung Kadun Jaya','Kadun Jaya adalah kampung yang berada di distrik Wania, Kabupaten Mimika, Mimika Tengah, Indonesia.','img-slider//687074b49e2da.jpg','#','2025-02-11 03:21:45','2025-07-11 09:19:33'),(2,'Sejarah Desa','Desa adalah desa yang terletak di kecamatan , Kabupaten , Provinsi , Kode Pos 0009999. Desa adalah desa yang terletak di kecamatan , Kabupaten , Provinsi , Kode Pos 0009999','img-slider//67aacc68000d2.png','#','2025-02-11 03:21:45','2025-02-11 04:07:32'),(3,'Visi & Misi','Visi & Misi desa KN dalah Terwujudnya masyarakat Desa OHA yang Bersih, Relegius, Sejahtera, Rapi dan Indah','img-slider//67aaca21bd8df.jpeg','#','2025-02-11 03:21:45','2025-02-11 04:07:50');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umkms`
--

DROP TABLE IF EXISTS `umkms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umkms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umkms`
--

LOCK TABLES `umkms` WRITE;
/*!40000 ALTER TABLE `umkms` DISABLE KEYS */;
INSERT INTO `umkms` VALUES (1,'img-produk/67aae72a74e39.jpeg','Kerajinan Rajut Eceng Gondok','kerajinan-rajut-eceng-gondok',150000,'<p>KERANJANG MINI ENCENG GONDOK DIMENSI 30X28X10 CM ( UKURAN PAKET )<br>DETAIL SIZE PRODUK : 30X18X10 CM<br>dikarenakan produk merupakan handmade wajar bila ada selisih dengan size yg tertera dideskripsi.<br><br>LANGSUNG PENGRAJIN , BELI DI MALL PASTI 100 LEBIH<br><br>LANGUNS AJA SIS.<br><br>NOTE : SUPAYA TIDAK RUSAK KAMI MENYEDIAKAN KARDUS BERBAYAR HANYA 500 RUPIAH , SILAHKAN CHECK OUT DI ETALASE<br><br>#ENCENGGONDOK #STORAGE #KERANJANGANYAMAN #SEAGRASS</p>','81212121212',1,'2025-02-11 05:59:06','2025-02-11 05:59:06'),(2,'img-produk/67aae9ee8b60f.png','Pisang Bolen','pisang-bolen',30000,'<p>Perpaduan pisang yang dibalut dengan kulit pastry yang renyah ini jadi camilan khas Bandung. Saat dimakan, kombinasi lembutnya pisang, manis gurihnya cokelat dan keju yang jadi isian rasa dan renyahnya pastry menjadikan camilan ini oleh-oleh khas yang wajib untuk dibeli.</p><p>Kamu bisa mendapatkan pisang bolen ini di Kartika Sari yang sudah memiliki 8 cabang. Gerai pertamanya berada di Jl. Haji Akbar, No. 4 Kebon Kawung yang lokasinya tidak jauh dari Stasiun Bandung. Di sini, pisang bolen disajikan dalam berbagai pilihan rasa, mulai dari Cokelat Keju, Durian Keju, Kacang Hijau, Peuyeum Keju, dan Keju Spesial.</p>','823343434343',1,'2025-02-11 06:10:54','2025-02-11 06:10:54'),(3,'img-produk/67aaeaf668166.jpeg','Dorokdokcu, Banjaran','dorokdokcu-banjaran',15000,'<p>Dorokdok Pedas Jeruk Brand: Dorokdokcu Rasa: Pedas daun jeruk Netto: 50gr Harga: Rp 10.000 Terbuat dari 100% kulit sapi . Ini enak banget rasanya pedes asin gurih plus ada sedikit rasa khas daun jeruknya, sobi micin dijamin nagih!!</p>','83434342323',1,'2025-02-11 06:15:18','2025-02-11 06:15:18');
/*!40000 ALTER TABLE `umkms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'img-profil//68707022724eb.png','admin','admin@gmail.com',NULL,'$2y$10$y524SMmxYHjWaYnq9OmZvOyo9tMISdjVPs72wj9ngvruf3sj7D0S2',NULL,'2025-02-11 03:21:45','2025-07-11 09:00:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_profils`
--

DROP TABLE IF EXISTS `video_profils`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video_profils` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_profils`
--

LOCK TABLES `video_profils` WRITE;
/*!40000 ALTER TABLE `video_profils` DISABLE KEYS */;
INSERT INTO `video_profils` VALUES (1,'https://www.youtube.com/embed/iP1FEO7oWyk',1,'2025-02-11 03:21:45','2025-07-11 09:00:49');
/*!40000 ALTER TABLE `video_profils` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visi_misis`
--

DROP TABLE IF EXISTS `visi_misis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visi_misis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visi_misis`
--

LOCK TABLES `visi_misis` WRITE;
/*!40000 ALTER TABLE `visi_misis` DISABLE KEYS */;
INSERT INTO `visi_misis` VALUES (1,'Terwujudnya Desa Cibuni yang sejahtera, mandiri, dan berbudaya','- Meningkatkan perekonomian masyarakat melalui pengembangan potensi pertanian, perkebunan, dan pariwisata\r\n                            - Meningkatkan kualitas sumber daya manusia melalui pendidikan dan kesehatan\r\n                            - Meningkatkan kesadaran masyarakat akan pentingnya kelestarian lingkungan',1,'2025-02-11 03:21:45','2025-02-11 06:56:45');
/*!40000 ALTER TABLE `visi_misis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilayahs`
--

DROP TABLE IF EXISTS `wilayahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wilayahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayahs`
--

LOCK TABLES `wilayahs` WRITE;
/*!40000 ALTER TABLE `wilayahs` DISABLE KEYS */;
INSERT INTO `wilayahs` VALUES (1,'Wilayah Kampung Kadun Jaya','<p>Kampung Kadun Jaya, Distrik Wania, Kota Timika, Kabupaten Mimika dengan luas wilayah daratan 22,516 KM2Ha. Akses menuju kampung Kadun Jaya sangat mudah, dapat ditempuh dengan kendaraan bermotor maupun mobil. Jalan menuju kampung Kadun Jaya sudah layak untuk dikatakan baik karena sepanjang jalanan sudah beraspal sempurna. Jarak dan waktu tempuh yang dibutuhkan apabila dari kampung Kadun Jaya menuju Ibukota Distrik kurang lebih 5 km dengan waktu kurang lebih 10 menit. Sedangkan jarak kampung dengan Ibukota Kabupaten kurang lebih 25 km dengan waktu tempuh kira-kira 40 menit.</p><p>Kampung Kadun Jaya berada di utara Distrik Kwamki Narama dan Distrik Tembaga Pura, kemudian bagian timur berbatasan dengan Distrik Mimika Baru, bagian selatan berbatasan dengan Distrik Mimika Timur dan Mimika Timur Jauh, dan bagian barat berbatasan dengan Distrik 64 Iwaka.</p>',1,'2025-02-11 03:21:45','2025-07-11 09:28:23');
/*!40000 ALTER TABLE `wilayahs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-11  2:43:48
