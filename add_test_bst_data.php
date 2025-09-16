<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Bansos;

echo '=== MENAMBAHKAN DATA BANSOS KATEGORI BARU UNTUK TEST ===' . PHP_EOL;

// Tambahkan data BST untuk test
$bstData = [
    'judul' => 'Bantuan Sosial Tunai - Test',
    'jenis_bansos' => 'BST',
    'jumlah_penerima' => 100,
    'jumlah_dana' => 50000000,
    'periode_mulai' => '2025-01-01',
    'periode_selesai' => '2025-12-31',
    'tahun' => 2025,
    'keterangan' => 'Data test untuk kategori BST',
    'tampil_infografis' => true,
    'warna_chart' => '#fd7e14',
    'user_id' => 1
];

try {
    $bansos = Bansos::create($bstData);
    echo 'Berhasil menambahkan data BST dengan ID: ' . $bansos->id . PHP_EOL;

    // Verifikasi data
    $all2025 = Bansos::where('tahun', 2025)->where('tampil_infografis', true)->get();
    echo PHP_EOL . 'Data 2025 aktif infografis:' . PHP_EOL;
    foreach ($all2025 as $item) {
        echo $item->jenis_bansos . ': ' . $item->jumlah_penerima . PHP_EOL;
    }

    $total2025 = $all2025->sum('jumlah_penerima');
    echo 'Total 2025: ' . $total2025 . PHP_EOL;

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}