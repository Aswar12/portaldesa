<?php

require_once 'vendor/autoload.php';

use App\Models\Penduduk;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "=== Checking alamat data in penduduks table ===\n";
    
    // Count total records with alamat
    $totalWithAlamat = Penduduk::whereNotNull('alamat')->where('alamat', '!=', '')->count();
    echo "Total records with alamat: " . $totalWithAlamat . "\n\n";
    
    if ($totalWithAlamat > 0) {
        echo "Sample alamat data:\n";
        echo "===================\n";
        $alamatData = Penduduk::select('nama', 'alamat')
            ->whereNotNull('alamat')
            ->where('alamat', '!=', '')
            ->limit(10)
            ->get();
            
        foreach ($alamatData as $index => $penduduk) {
            echo ($index + 1) . ". " . $penduduk->nama . "\n";
            echo "   Alamat: " . $penduduk->alamat . "\n";
            
            // Check if contains RT pattern
            $alamat = strtolower($penduduk->alamat);
            if (preg_match('/rt[\s]*(\d+)/', $alamat, $matches)) {
                echo "   RT Found: RT " . str_pad($matches[1], 2, '0', STR_PAD_LEFT) . "\n";
            } elseif (preg_match('/(\d+)/', $alamat, $matches)) {
                echo "   Number Found: " . $matches[1] . " (could be RT)\n";
            } else {
                echo "   No RT pattern found\n";
            }
            echo "\n";
        }
    } else {
        echo "No alamat data found. Let's check all records:\n";
        $totalRecords = Penduduk::count();
        echo "Total penduduk records: " . $totalRecords . "\n";
        
        if ($totalRecords > 0) {
            echo "\nSample penduduk data:\n";
            $sampleData = Penduduk::select('nama', 'alamat')->limit(5)->get();
            foreach ($sampleData as $index => $penduduk) {
                echo ($index + 1) . ". " . $penduduk->nama . "\n";
                echo "   Alamat: " . ($penduduk->alamat ?: '(null/empty)') . "\n\n";
            }
        }
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
