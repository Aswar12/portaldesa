<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Bansos;

echo 'Total bansos records: ' . Bansos::count() . PHP_EOL;
echo 'Active infografis: ' . Bansos::where('tampil_infografis', true)->count() . PHP_EOL;
echo 'Total penerima all: ' . Bansos::sum('jumlah_penerima') . PHP_EOL;
echo 'Total penerima active: ' . Bansos::where('tampil_infografis', true)->sum('jumlah_penerima') . PHP_EOL;

$latestYear = Bansos::where('tampil_infografis', true)->max('tahun');
echo 'Latest year: ' . $latestYear . PHP_EOL;
echo 'Total penerima latest year active: ' . Bansos::where('tampil_infografis', true)->where('tahun', $latestYear)->sum('jumlah_penerima') . PHP_EOL;

// Detail per jenis untuk tahun terbaru
$currentYearData = Bansos::where('tampil_infografis', true)->where('tahun', $latestYear)->get();
echo PHP_EOL . 'Detail untuk tahun ' . $latestYear . ':' . PHP_EOL;
$pkh = $currentYearData->where('jenis_bansos', 'PKH')->sum('jumlah_penerima');
$blt = $currentYearData->where('jenis_bansos', 'BLT')->sum('jumlah_penerima');
$sembako = $currentYearData->where('jenis_bansos', 'Sembako')->sum('jumlah_penerima');
echo 'PKH: ' . $pkh . PHP_EOL;
echo 'BLT: ' . $blt . PHP_EOL;
echo 'Sembako: ' . $sembako . PHP_EOL;
echo 'Total: ' . ($pkh + $blt + $sembako) . PHP_EOL;

// Semua data tanpa filter tahun
echo PHP_EOL . 'Semua data aktif infografis:' . PHP_EOL;
$allActive = Bansos::where('tampil_infografis', true)->get();
foreach ($allActive as $bansos) {
    echo $bansos->tahun . ' - ' . $bansos->jenis_bansos . ': ' . $bansos->jumlah_penerima . PHP_EOL;
}