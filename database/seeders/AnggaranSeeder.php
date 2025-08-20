<?php

namespace Database\Seeders;

use App\Models\Anggaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnggaranSeeder extends Seeder
{
    public function run()
    {
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;
        
        // Data APBDes untuk tahun sekarang (2025)
        $anggaranData2025 = [
            // PENDAPATAN
            [
                'judul' => 'Dana Desa',
                'slug' => 'dana-desa-' . $currentYear,
                'keterangan' => 'Dana Desa dari APBN tahun ' . $currentYear,
                'gambar' => '',
                'jenis' => 'pendapatan',
                'kategori' => 'Transfer',
                'jumlah' => 800000000, // 800 juta
                'realisasi' => 700000000, // 700 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Dana transfer dari pemerintah pusat melalui APBN untuk pembangunan desa',
                'user_id' => 1,
            ],
            [
                'judul' => 'Alokasi Dana Desa (ADD)',
                'slug' => 'add-' . $currentYear,
                'keterangan' => 'Alokasi Dana Desa dari APBD Kabupaten',
                'gambar' => '',
                'jenis' => 'pendapatan',
                'kategori' => 'Transfer',
                'jumlah' => 300000000, // 300 juta
                'realisasi' => 280000000, // 280 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Alokasi dana dari APBD Kabupaten untuk operasional pemerintahan desa',
                'user_id' => 1,
            ],
            [
                'judul' => 'Pendapatan Asli Desa (PADes)',
                'slug' => 'pades-' . $currentYear,
                'keterangan' => 'Pendapatan Asli Desa dari berbagai sumber',
                'gambar' => '',
                'jenis' => 'pendapatan',
                'kategori' => 'PADes',
                'jumlah' => 150000000, // 150 juta
                'realisasi' => 120000000, // 120 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Pendapatan asli desa dari retribusi, sewa, dan usaha desa lainnya',
                'user_id' => 1,
            ],
            
            // BELANJA
            [
                'judul' => 'Belanja Pegawai',
                'slug' => 'belanja-pegawai-' . $currentYear,
                'keterangan' => 'Belanja untuk gaji dan tunjangan pegawai desa',
                'gambar' => '',
                'jenis' => 'belanja',
                'kategori' => 'Belanja Pegawai',
                'jumlah' => 400000000, // 400 juta
                'realisasi' => 380000000, // 380 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Anggaran untuk gaji kepala desa, perangkat desa, dan tunjangan lainnya',
                'user_id' => 1,
            ],
            [
                'judul' => 'Belanja Barang dan Jasa',
                'slug' => 'belanja-barang-jasa-' . $currentYear,
                'keterangan' => 'Belanja operasional dan pemeliharaan',
                'gambar' => '',
                'jenis' => 'belanja',
                'kategori' => 'Belanja Barang/Jasa',
                'jumlah' => 200000000, // 200 juta
                'realisasi' => 180000000, // 180 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Belanja untuk keperluan operasional kantor, pemeliharaan, dan jasa lainnya',
                'user_id' => 1,
            ],
            [
                'judul' => 'Belanja Modal',
                'slug' => 'belanja-modal-' . $currentYear,
                'keterangan' => 'Belanja untuk infrastruktur dan pembangunan',
                'gambar' => '',
                'jenis' => 'belanja',
                'kategori' => 'Belanja Modal',
                'jumlah' => 450000000, // 450 juta
                'realisasi' => 400000000, // 400 juta
                'tahun_anggaran' => $currentYear,
                'deskripsi' => 'Anggaran untuk pembangunan infrastruktur, jalan, jembatan, dan fasilitas umum',
                'user_id' => 1,
            ],
        ];

        // Data APBDes untuk tahun lalu (2024)
        $anggaranData2024 = [
            [
                'judul' => 'Dana Desa',
                'slug' => 'dana-desa-' . $lastYear,
                'keterangan' => 'Dana Desa dari APBN tahun ' . $lastYear,
                'gambar' => '',
                'jenis' => 'pendapatan',
                'kategori' => 'Transfer',
                'jumlah' => 750000000,
                'realisasi' => 750000000,
                'tahun_anggaran' => $lastYear,
                'deskripsi' => 'Dana transfer dari pemerintah pusat',
                'user_id' => 1,
            ],
            [
                'judul' => 'Alokasi Dana Desa (ADD)',
                'slug' => 'add-' . $lastYear,
                'keterangan' => 'Alokasi Dana Desa dari APBD Kabupaten',
                'gambar' => '',
                'jenis' => 'pendapatan',
                'kategori' => 'Transfer',
                'jumlah' => 280000000,
                'realisasi' => 280000000,
                'tahun_anggaran' => $lastYear,
                'deskripsi' => 'Alokasi dana dari APBD Kabupaten',
                'user_id' => 1,
            ],
            [
                'judul' => 'Belanja Pegawai',
                'slug' => 'belanja-pegawai-' . $lastYear,
                'keterangan' => 'Belanja untuk gaji dan tunjangan pegawai desa',
                'gambar' => '',
                'jenis' => 'belanja',
                'kategori' => 'Belanja Pegawai',
                'jumlah' => 350000000,
                'realisasi' => 350000000,
                'tahun_anggaran' => $lastYear,
                'deskripsi' => 'Anggaran untuk gaji kepala desa dan perangkat desa',
                'user_id' => 1,
            ],
            [
                'judul' => 'Belanja Modal',
                'slug' => 'belanja-modal-' . $lastYear,
                'keterangan' => 'Belanja untuk infrastruktur dan pembangunan',
                'gambar' => '',
                'jenis' => 'belanja',
                'kategori' => 'Belanja Modal',
                'jumlah' => 480000000,
                'realisasi' => 450000000,
                'tahun_anggaran' => $lastYear,
                'deskripsi' => 'Anggaran untuk pembangunan infrastruktur desa',
                'user_id' => 1,
            ],
        ];

        // Insert data
        foreach (array_merge($anggaranData2025, $anggaranData2024) as $data) {
            Anggaran::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
