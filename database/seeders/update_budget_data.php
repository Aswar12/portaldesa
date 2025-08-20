<?php

use App\Models\Anggaran;

// Update existing records with zero values
$updated = Anggaran::where('jumlah', 0.00)->update([
    'jumlah' => 100000000,  // 100 million
    'realisasi' => 80000000 // 80 million
]);

echo "Updated $updated anggaran records\n";

// Add some additional sample data for different categories if they don't exist
$sampleData = [
    [
        'judul' => 'Dana Alokasi Desa',
        'slug' => 'dana-alokasi-desa-2025',
        'keterangan' => '<p>Dana alokasi dari pemerintah daerah</p>',
        'jenis' => 'pendapatan',
        'jumlah' => 300000000,
        'realisasi' => 250000000,
        'tahun_anggaran' => 2025,
        'kategori' => 'Transfer',
        'deskripsi' => 'Dana transfer dari pemerintah daerah',
        'gambar' => '',
        'user_id' => 1
    ],
    [
        'judul' => 'Belanja Pembangunan',
        'slug' => 'belanja-pembangunan-2025',
        'keterangan' => '<p>Belanja untuk pembangunan infrastruktur</p>',
        'jenis' => 'belanja',
        'jumlah' => 500000000,
        'realisasi' => 400000000,
        'tahun_anggaran' => 2025,
        'kategori' => 'Infrastruktur',
        'deskripsi' => 'Belanja pembangunan infrastruktur desa',
        'gambar' => '',
        'user_id' => 1
    ]
];

foreach ($sampleData as $data) {
    $existing = Anggaran::where('slug', $data['slug'])->first();
    if (!$existing) {
        Anggaran::create($data);
        echo "Created anggaran: " . $data['judul'] . "\n";
    } else {
        echo "Skipped existing anggaran: " . $data['judul'] . "\n";
    }
}

// Show summary
$total = Anggaran::count();
$totalAnggaran = Anggaran::sum('jumlah');
$totalRealisasi = Anggaran::sum('realisasi');

echo "\n=== SUMMARY ===\n";
echo "Total records: $total\n";
echo "Total anggaran: Rp " . number_format($totalAnggaran, 0, ',', '.') . "\n";
echo "Total realisasi: Rp " . number_format($totalRealisasi, 0, ',', '.') . "\n";

// Show by category
$pendapatan = Anggaran::where('jenis', 'pendapatan')->sum('jumlah');
$belanja = Anggaran::where('jenis', 'belanja')->sum('jumlah'); 
$pembiayaan = Anggaran::where('jenis', 'pembiayaan')->sum('jumlah');

echo "\n=== BY CATEGORY ===\n";
echo "Pendapatan: Rp " . number_format($pendapatan, 0, ',', '.') . "\n";
echo "Belanja: Rp " . number_format($belanja, 0, ',', '.') . "\n";
echo "Pembiayaan: Rp " . number_format($pembiayaan, 0, ',', '.') . "\n";
