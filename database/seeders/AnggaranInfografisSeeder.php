<?php

namespace Database\Seeders;

use App\Models\Anggaran;
use Illuminate\Database\Seeder;

class AnggaranInfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggaransData = [
            [
                'judul' => 'Pembangunan Jalan Desa',
                'slug' => 'pembangunan-jalan-desa',
                'keterangan' => 'Pembangunan dan perbaikan infrastruktur jalan desa untuk meningkatkan aksesibilitas masyarakat',
                'jenis' => 'belanja',
                'jumlah' => 500000000,
                'realisasi' => 450000000,
                'tahun_anggaran' => 2024,
                'kategori' => 'Infrastruktur',
                'deskripsi' => 'Pembangunan jalan sepanjang 2 km dengan spesifikasi jalan beton',
                'warna_chart' => '#28a745',
                'tampil_infografis' => true,
                'urutan_chart' => 1,
                'user_id' => 1,
            ],
            [
                'judul' => 'Program Bantuan Kesehatan',
                'slug' => 'program-bantuan-kesehatan',
                'keterangan' => 'Program bantuan kesehatan untuk masyarakat kurang mampu dan lansia',
                'jenis' => 'belanja',
                'jumlah' => 200000000,
                'realisasi' => 180000000,
                'tahun_anggaran' => 2024,
                'kategori' => 'Kesehatan',
                'deskripsi' => 'Bantuan pengobatan gratis dan vitamin untuk masyarakat',
                'warna_chart' => '#dc3545',
                'tampil_infografis' => true,
                'urutan_chart' => 2,
                'user_id' => 1,
            ],
            [
                'judul' => 'Retribusi Pasar Desa',
                'slug' => 'retribusi-pasar-desa',
                'keterangan' => 'Pendapatan dari retribusi pasar desa dan kios-kios pedagang',
                'jenis' => 'pendapatan',
                'jumlah' => 150000000,
                'realisasi' => 140000000,
                'tahun_anggaran' => 2024,
                'kategori' => 'Retribusi',
                'deskripsi' => 'Pendapatan rutin dari pasar desa dan area perdagangan',
                'warna_chart' => '#007bff',
                'tampil_infografis' => true,
                'urutan_chart' => 3,
                'user_id' => 1,
            ],
            [
                'judul' => 'Dana Desa dari Pusat',
                'slug' => 'dana-desa-dari-pusat',
                'keterangan' => 'Transfer dana desa yang berasal dari APBN untuk pembangunan desa',
                'jenis' => 'pendapatan',
                'jumlah' => 800000000,
                'realisasi' => 800000000,
                'tahun_anggaran' => 2024,
                'kategori' => 'Transfer',
                'deskripsi' => 'Dana transfer dari pemerintah pusat untuk pembangunan desa',
                'warna_chart' => '#17a2b8',
                'tampil_infografis' => true,
                'urutan_chart' => 4,
                'user_id' => 1,
            ],
            [
                'judul' => 'Program Pendidikan PAUD',
                'slug' => 'program-pendidikan-paud',
                'keterangan' => 'Program pendidikan anak usia dini untuk meningkatkan kualitas SDM desa',
                'jenis' => 'belanja',
                'jumlah' => 120000000,
                'realisasi' => 100000000,
                'tahun_anggaran' => 2024,
                'kategori' => 'Pendidikan',
                'deskripsi' => 'Operasional PAUD dan penyediaan sarana pembelajaran',
                'warna_chart' => '#ffc107',
                'tampil_infografis' => true,
                'urutan_chart' => 5,
                'user_id' => 1,
            ]
        ];

        foreach ($anggaransData as $data) {
            Anggaran::create($data);
        }
    }
}
