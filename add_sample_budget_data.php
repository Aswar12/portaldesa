<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Anggaran;

try {
    // Update existing records with zero values
    $updated = Anggaran::where('jumlah', 0.00)->update([
        'jumlah' => 100000000,  // 100 million
        'realisasi' => 80000000 // 80 million
    ]);
    
    echo "Updated $updated anggaran records\n";
    
    // Add some additional sample data for different categories
    $sampleData = [
        [
            'judul' => 'Dana Alokasi Desa',
            'slug' => 'dana-alokasi-desa',
            'keterangan' => '<p>Dana alokasi dari pemerintah daerah</p>',
            'jenis' => 'pendapatan',
            'jumlah' => 300000000,
            'realisasi' => 250000000,
            'tahun_anggaran' => 2025,
            'kategori' => 'Transfer',
            'deskripsi' => 'Dana transfer dari pemerintah daerah',
            'user_id' => 1
        ],
        [
            'judul' => 'Pendapatan Asli Desa',
            'slug' => 'pendapatan-asli-desa',
            'keterangan' => '<p>Pendapatan dari hasil usaha desa</p>',
            'jenis' => 'pendapatan',
            'jumlah' => 50000000,
            'realisasi' => 45000000,
            'tahun_anggaran' => 2025,
            'kategori' => 'PAD',
            'deskripsi' => 'Pendapatan asli dari usaha desa',
            'user_id' => 1
        ],
        [
            'judul' => 'Belanja Pembangunan',
            'slug' => 'belanja-pembangunan',
            'keterangan' => '<p>Belanja untuk pembangunan infrastruktur</p>',
            'jenis' => 'belanja',
            'jumlah' => 500000000,
            'realisasi' => 400000000,
            'tahun_anggaran' => 2025,
            'kategori' => 'Infrastruktur',
            'deskripsi' => 'Belanja pembangunan infrastruktur desa',
            'user_id' => 1
        ],
        [
            'judul' => 'Belanja Operasional',
            'slug' => 'belanja-operasional',
            'keterangan' => '<p>Belanja operasional pemerintahan desa</p>',
            'jenis' => 'belanja',
            'jumlah' => 200000000,
            'realisasi' => 180000000,
            'tahun_anggaran' => 2025,
            'kategori' => 'Operasional',
            'deskripsi' => 'Belanja operasional pemerintahan',
            'user_id' => 1
        ]
    ];
    
    foreach ($sampleData as $data) {
        $existing = Anggaran::where('slug', $data['slug'])->first();
        if (!$existing) {
            Anggaran::create($data);
            echo "Created anggaran: " . $data['judul'] . "\n";
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
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
