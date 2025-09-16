<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Bansos;
use App\Models\Penduduk;

echo "=== DEBUG BANSOS VIEW DATA ===" . PHP_EOL;

// Ambil data bansos yang aktif untuk infografis
$bansosData = Bansos::where('tampil_infografis', true)
    ->orderBy('tahun', 'DESC')
    ->orderBy('id', 'DESC')
    ->get();

echo "Total bansos data: " . $bansosData->count() . PHP_EOL;

if ($bansosData->isNotEmpty()) {
    // Ambil tahun terbaru dari data yang aktif
    $latestYear = $bansosData->first()->tahun;
    echo "Latest year: " . $latestYear . PHP_EOL;
    
    // Filter data berdasarkan tahun terbaru
    $currentYearData = $bansosData->where('tahun', $latestYear);
    echo "Current year data count: " . $currentYearData->count() . PHP_EOL;
    
    $totalPenerima = $currentYearData->sum('jumlah_penerima');
    $totalNominal = $currentYearData->sum('jumlah_dana');
    
    echo "Total penerima current year: " . $totalPenerima . PHP_EOL;
    echo "Total nominal current year: " . $totalNominal . PHP_EOL;
    
    // Data berdasarkan jenis bansos untuk tahun terbaru
    $bansosByType = [];
    
    echo PHP_EOL . "Building bansosByType array:" . PHP_EOL;
    foreach ($currentYearData->groupBy('jenis_bansos') as $jenis => $data) {
        $jumlah = $data->sum('jumlah_penerima');
        $bansosByType[$jenis] = $jumlah;
        echo "- {$jenis}: {$jumlah}" . PHP_EOL;
    }
    
    echo PHP_EOL . "Final bansosByType array:" . PHP_EOL;
    print_r($bansosByType);
    
    // Helper function untuk info bansos
    $bansosInfo = [
        'PKH' => ['color' => 'linear-gradient(135deg, #28a745 0%, #20c997 100%)', 'desc' => 'Program Keluarga Harapan'],
        'BPNT' => ['color' => 'linear-gradient(135deg, #28a745 0%, #20c997 100%)', 'desc' => 'Bantuan Pangan Non Tunai'],
        'BLT' => ['color' => 'linear-gradient(135deg, #007bff 0%, #6610f2 100%)', 'desc' => 'Bantuan Langsung Tunai'],
        'Sembako' => ['color' => 'linear-gradient(135deg, #dc3545 0%, #e83e8c 100%)', 'desc' => 'Bantuan Sembilan Bahan Pokok'],
        'BST' => ['color' => 'linear-gradient(135deg, #fd7e14 0%, #ffc107 100%)', 'desc' => 'Bantuan Sosial Tunai'],
        'PBI' => ['color' => 'linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%)', 'desc' => 'Penerima Bantuan Iuran'],
    ];
    
    echo PHP_EOL . "BansosInfo array keys:" . PHP_EOL;
    print_r(array_keys($bansosInfo));
    
    echo PHP_EOL . "Checking which cards should be displayed:" . PHP_EOL;
    foreach($bansosByType as $jenis => $jumlah) {
        if($jumlah > 0) {
            $info = $bansosInfo[$jenis] ?? ['color' => 'linear-gradient(135deg, #6c757d 0%, #495057 100%)', 'desc' => 'Bantuan Sosial'];
            echo "- {$jenis}: {$jumlah} penerima - {$info['desc']}" . PHP_EOL;
        }
    }
}