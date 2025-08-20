<?php

// Bootstrap Laravel
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Penduduk;

// Test RT data parsing
$allPenduduk = Penduduk::select('alamat', 'jenis_kelamin')
    ->whereNotNull('alamat')
    ->where('alamat', '!=', '')
    ->limit(20)
    ->get();

echo "=== SAMPLE DATA ALAMAT ===\n";
foreach ($allPenduduk as $penduduk) {
    $alamat = strtoupper(trim($penduduk->alamat));
    $rt = 'RT Tidak Diketahui';
    
    // Pattern matching untuk ekstrak RT
    if (preg_match('/RT[\s\.\-]*(\d{1,2})/', $alamat, $matches)) {
        $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
        $rt = 'RT ' . $rtNumber;
    }
    elseif (preg_match('/^(\d{1,2})[\s\.\-]/', $alamat, $matches)) {
        $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
        $rt = 'RT ' . $rtNumber;
    }
    
    echo "Alamat: " . $penduduk->alamat . " -> Parsed: " . $rt . " (" . $penduduk->jenis_kelamin . ")\n";
}

// Test full distribution
echo "\n=== DISTRIBUSI RT ===\n";
$allData = Penduduk::select('alamat', 'jenis_kelamin')
    ->whereNotNull('alamat')
    ->where('alamat', '!=', '')
    ->get();

$rtData = collect();

foreach ($allData as $penduduk) {
    $alamat = strtoupper(trim($penduduk->alamat));
    $rt = 'RT Tidak Diketahui';
    
    if (preg_match('/RT[\s\.\-]*(\d{1,2})/', $alamat, $matches)) {
        $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
        $rt = 'RT ' . $rtNumber;
    }
    elseif (preg_match('/^(\d{1,2})[\s\.\-]/', $alamat, $matches)) {
        $rtNumber = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
        $rt = 'RT ' . $rtNumber;
    }
    
    if (!$rtData->has($rt)) {
        $rtData->put($rt, [
            'laki_laki' => 0,
            'perempuan' => 0
        ]);
    }
    
    if (strtolower($penduduk->jenis_kelamin) === 'laki-laki') {
        $rtData[$rt]['laki_laki']++;
    } else {
        $rtData[$rt]['perempuan']++;
    }
}

$rtChartData = $rtData->map(function ($data) {
    return [
        'laki_laki' => $data['laki_laki'],
        'perempuan' => $data['perempuan'],
        'total' => $data['laki_laki'] + $data['perempuan']
    ];
})
->sortByKeys()
->filter(function ($data, $rt) {
    return $rt !== 'RT Tidak Diketahui' || $data['total'] > 0;
});

foreach ($rtChartData as $rt => $data) {
    echo sprintf("%-15s: L=%3d, P=%3d, Total=%3d\n", 
        $rt, 
        $data['laki_laki'], 
        $data['perempuan'], 
        $data['total']
    );
}

echo "\nTotal RT dengan data: " . $rtChartData->count() . "\n";
echo "Total penduduk dengan alamat: " . $allData->count() . "\n";
