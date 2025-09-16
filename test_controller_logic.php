<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Bansos;
use App\Models\Penduduk;

echo '=== TESTING INFOGRAFIS CONTROLLER LOGIC ===' . PHP_EOL;

// Simulate the controller logic
$bansosData = Bansos::where('tampil_infografis', true)
    ->orderBy('tahun', 'DESC')
    ->orderBy('id', 'DESC')
    ->get();

if ($bansosData->isNotEmpty()) {
    $latestYear = $bansosData->first()->tahun;
    $currentYearData = $bansosData->where('tahun', $latestYear);

    $totalPenerima = $currentYearData->sum('jumlah_penerima');

    // Data berdasarkan jenis bansos untuk tahun terbaru - DINAMIS
    $bansosByType = [];
    $pkh = 0;
    $blt = 0;
    $sembako = 0;

    // Kelompokkan data berdasarkan jenis bansos
    foreach ($currentYearData->groupBy('jenis_bansos') as $jenis => $data) {
        $jumlah = $data->sum('jumlah_penerima');
        $bansosByType[$jenis] = $jumlah;

        // Tetap maintain variabel lama untuk backward compatibility
        if (in_array($jenis, ['PKH', 'BPNT'])) {
            $pkh += $jumlah;
        } elseif ($jenis == 'BLT') {
            $blt = $jumlah;
        } elseif ($jenis == 'Sembako') {
            $sembako = $jumlah;
        }
    }

    echo 'Latest Year: ' . $latestYear . PHP_EOL;
    echo 'Total Penerima: ' . $totalPenerima . PHP_EOL;
    echo 'PKH (legacy): ' . $pkh . PHP_EOL;
    echo 'BLT (legacy): ' . $blt . PHP_EOL;
    echo 'Sembako (legacy): ' . $sembako . PHP_EOL;
    echo PHP_EOL . 'Bansos By Type (Dynamic):' . PHP_EOL;
    foreach ($bansosByType as $jenis => $jumlah) {
        echo $jenis . ': ' . $jumlah . PHP_EOL;
    }
} else {
    echo 'No bansos data found' . PHP_EOL;
}