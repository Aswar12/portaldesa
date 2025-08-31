<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggaran;

class SampleAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggarans = [
            [
                'judul' => 'Dana Desa Tahun 2025',
                'slug' => 'dana-desa-tahun-2025',
                'keterangan' => '<p>Dana Desa yang diterima dari pemerintah pusat untuk pembangunan desa tahun 2025</p>',
                'jenis' => 'pendapatan',
                'jumlah' => 800000000,
                'realisasi' => 800000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Transfer Pemerintah',
                'deskripsi' => 'Dana transfer langsung dari pemerintah pusat',
                'tampil_infografis' => true,
                'warna_chart' => '#28a745',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Alokasi Dana Desa 2025',
                'slug' => 'alokasi-dana-desa-2025',
                'keterangan' => '<p>Alokasi Dana Desa dari pemerintah kabupaten</p>',
                'jenis' => 'pendapatan',
                'jumlah' => 500000000,
                'realisasi' => 500000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Transfer Daerah',
                'deskripsi' => 'Dana dari pemerintah kabupaten',
                'tampil_infografis' => true,
                'warna_chart' => '#17a2b8',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Pajak Bumi dan Bangunan',
                'slug' => 'pajak-bumi-dan-bangunan',
                'keterangan' => '<p>Bagian dari Pajak Bumi dan Bangunan yang diterima desa</p>',
                'jenis' => 'pendapatan',
                'jumlah' => 50000000,
                'realisasi' => 45000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Pajak Daerah',
                'deskripsi' => 'Bagi hasil pajak dari kabupaten',
                'tampil_infografis' => true,
                'warna_chart' => '#ffc107',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Pembangunan Infrastruktur',
                'slug' => 'pembangunan-infrastruktur',
                'keterangan' => '<p>Belanja untuk pembangunan jalan, jembatan, dan infrastruktur lainnya</p>',
                'jenis' => 'belanja',
                'jumlah' => 600000000,
                'realisasi' => 450000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Infrastruktur',
                'deskripsi' => 'Pembangunan dan perbaikan infrastruktur desa',
                'tampil_infografis' => true,
                'warna_chart' => '#dc3545',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Program Kesehatan Masyarakat',
                'slug' => 'program-kesehatan-masyarakat',
                'keterangan' => '<p>Belanja untuk program kesehatan, posyandu, dan layanan kesehatan desa</p>',
                'jenis' => 'belanja',
                'jumlah' => 150000000,
                'realisasi' => 120000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Kesehatan',
                'deskripsi' => 'Program kesehatan dan pelayanan medis',
                'tampil_infografis' => true,
                'warna_chart' => '#e83e8c',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Program Pendidikan',
                'slug' => 'program-pendidikan',
                'keterangan' => '<p>Belanja untuk program pendidikan dan pengembangan SDM</p>',
                'jenis' => 'belanja',
                'jumlah' => 200000000,
                'realisasi' => 180000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Pendidikan',
                'deskripsi' => 'Program pendidikan dan pelatihan masyarakat',
                'tampil_infografis' => true,
                'warna_chart' => '#6610f2',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Operasional Pemerintah Desa',
                'slug' => 'operasional-pemerintah-desa',
                'keterangan' => '<p>Belanja rutin untuk operasional pemerintah desa</p>',
                'jenis' => 'belanja',
                'jumlah' => 300000000,
                'realisasi' => 280000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Operasional',
                'deskripsi' => 'Gaji pegawai dan operasional kantor',
                'tampil_infografis' => true,
                'warna_chart' => '#6c757d',
                'user_id' => 1,
                'gambar' => null
            ],
            [
                'judul' => 'Dana Cadangan Desa',
                'slug' => 'dana-cadangan-desa',
                'keterangan' => '<p>Pembiayaan untuk dana cadangan desa</p>',
                'jenis' => 'pembiayaan',
                'jumlah' => 100000000,
                'realisasi' => 100000000,
                'tahun_anggaran' => 2025,
                'kategori' => 'Cadangan',
                'deskripsi' => 'Dana cadangan untuk keperluan mendesak',
                'tampil_infografis' => true,
                'warna_chart' => '#fd7e14',
                'user_id' => 1,
                'gambar' => null
            ]
        ];

        foreach ($anggarans as $anggaran) {
            // Check if anggaran with same slug already exists
            if (!Anggaran::where('slug', $anggaran['slug'])->exists()) {
                Anggaran::create($anggaran);
            }
        }

        $this->command->info('Sample anggaran data seeded successfully.');
    }
}
