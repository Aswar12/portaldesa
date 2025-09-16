<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Bansos;

echo '=== SEMUA DATA BANSOS ===' . PHP_EOL;
$allBansos = Bansos::all();
foreach ($allBansos as $bansos) {
    echo sprintf("%d - %s: %d penerima, Infografis: %s\n",
        $bansos->tahun,
        $bansos->jenis_bansos,
        $bansos->jumlah_penerima,
        $bansos->tampil_infografis ? 'Ya' : 'Tidak'
    );
}

echo PHP_EOL . '=== DATA TIDAK AKTIF INFOGRAFIS ===' . PHP_EOL;
$inactiveBansos = Bansos::where('tampil_infografis', false)->get();
if ($inactiveBansos->isEmpty()) {
    echo 'Tidak ada data yang tidak aktif infografis' . PHP_EOL;
} else {
    foreach ($inactiveBansos as $bansos) {
        echo sprintf("%d - %s: %d penerima\n",
            $bansos->tahun,
            $bansos->jenis_bansos,
            $bansos->jumlah_penerima
        );
    }
}

echo PHP_EOL . '=== TOTAL PER JENIS (SEMUA DATA) ===' . PHP_EOL;
$totalPkh = Bansos::where('jenis_bansos', 'PKH')->sum('jumlah_penerima');
$totalBlt = Bansos::where('jenis_bansos', 'BLT')->sum('jumlah_penerima');
$totalBpnt = Bansos::where('jenis_bansos', 'BPNT')->sum('jumlah_penerima');
$totalSembako = Bansos::where('jenis_bansos', 'Sembako')->sum('jumlah_penerima');

echo 'PKH: ' . $totalPkh . PHP_EOL;
echo 'BLT: ' . $totalBlt . PHP_EOL;
echo 'BPNT: ' . $totalBpnt . PHP_EOL;
echo 'Sembako: ' . $totalSembako . PHP_EOL;
echo 'Total semua: ' . ($totalPkh + $totalBlt + $totalBpnt + $totalSembako) . PHP_EOL;

echo PHP_EOL . '=== TOTAL PER JENIS (TAHUN 2025 AKTIF INFOGRAFIS) ===' . PHP_EOL;
$currentYearData = Bansos::where('tampil_infografis', true)->where('tahun', 2025)->get();
$pkh2025 = $currentYearData->where('jenis_bansos', 'PKH')->sum('jumlah_penerima');
$blt2025 = $currentYearData->where('jenis_bansos', 'BLT')->sum('jumlah_penerima');
$bpnt2025 = $currentYearData->where('jenis_bansos', 'BPNT')->sum('jumlah_penerima');
$sembako2025 = $currentYearData->where('jenis_bansos', 'Sembako')->sum('jumlah_penerima');

echo 'PKH: ' . $pkh2025 . PHP_EOL;
echo 'BLT: ' . $blt2025 . PHP_EOL;
echo 'BPNT: ' . $bpnt2025 . PHP_EOL;
echo 'Sembako: ' . $sembako2025 . PHP_EOL;
echo 'Total 2025 aktif: ' . ($pkh2025 + $blt2025 + $bpnt2025 + $sembako2025) . PHP_EOL;