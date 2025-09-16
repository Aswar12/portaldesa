# FLOW DATA BANSOS - ADMIN KE LANDING PAGE

## 🎯 KONDISI AWAL
- Admin belum ada data bansos
- Landing page menampilkan: "Belum Ada Data Bantuan Sosial"

## 📝 LANGKAH 1: ADMIN MENAMBAH 4 DATA BANSOS

### Data yang Ditambahkan:
1. **PKH 2024** - 150 penerima - Rp 450.000.000
2. **BLT 2024** - 200 penerima - Rp 600.000.000  
3. **Sembako 2024** - 100 penerima - Rp 300.000.000
4. **PKH 2025** - 175 penerima - Rp 525.000.000

### Status Default Setelah Input:
- Semua data: `tampil_infografis = false` (TIDAK AKTIF)
- Admin page: Menampilkan 4 data ✅
- Landing page: Masih "Belum Ada Data" ❌

## ⚠️ MASALAH: DATA TIDAK SINKRON!

**Mengapa landing page kosong?**
Karena InfografisController hanya mengambil data dengan:
```php
Bansos::where('tampil_infografis', true)
```

Semua 4 data baru masih `tampil_infografis = false`

## ✅ SOLUSI: AKTIFKAN DATA UNTUK INFOGRAFIS

### Cara 1: Toggle Cepat di Admin
1. Buka halaman admin bansos
2. Klik tombol mata (👁️) di kolom "Aksi" untuk data yang ingin ditampilkan
3. Tombol akan berubah dari outline ke hijau penuh
4. Data langsung aktif untuk infografis

### Cara 2: Edit Manual
1. Klik "Edit" pada data bansos
2. Centang "Tampilkan di Halaman Infografis"
3. Simpan

## 📊 HASIL SETELAH AKTIVASI

### Jika Mengaktifkan 3 dari 4 data:
**Yang Diaktifkan:**
- PKH 2024 ✅
- BLT 2024 ✅  
- Sembako 2024 ✅

**Yang TIDAK Diaktifkan:**
- PKH 2025 ❌

### Tampilan Admin:
- Total data: 4
- Warning: "1 dari 4 data bansos tidak ditampilkan di halaman infografis"

### Tampilan Landing Page:
- Total Penerima: 450 (150+200+100)
- PKH: 150 penerima
- BLT: 200 penerima
- Sembako: 100 penerima
- Total Nominal: Rp 1.350.000.000
- Data historical: Hanya dari data yang aktif

## 🔍 FILTER DI ADMIN

### Filter "Aktif di Infografis":
- Akan menampilkan 3 data yang aktif

### Filter "Tidak Aktif di Infografis":  
- Akan menampilkan 1 data (PKH 2025)

### Filter "Semua Status":
- Menampilkan semua 4 data
