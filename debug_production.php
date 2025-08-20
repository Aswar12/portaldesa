<?php
// Debug script untuk memeriksa data di server production
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Penduduk;

echo "=== DEBUGGING DATA PENDUDUK ===\n\n";

try {
    // Test koneksi database
    echo "1. Testing database connection...\n";
    $connection = \DB::connection();
    $pdo = $connection->getPdo();
    echo "✅ Database connection: SUCCESS\n";
    echo "Database name: " . $connection->getDatabaseName() . "\n\n";
    
    // Cek apakah tabel penduduk ada
    echo "2. Checking penduduk table...\n";
    $tableExists = \Schema::hasTable('penduduks');
    echo $tableExists ? "✅ Table 'penduduks' exists\n" : "❌ Table 'penduduks' does not exist\n";
    
    if ($tableExists) {
        // Cek jumlah record
        echo "\n3. Checking data count...\n";
        $totalCount = Penduduk::count();
        echo "Total records: " . $totalCount . "\n";
        
        if ($totalCount > 0) {
            // Sample data
            echo "\n4. Sample data (first 5 records):\n";
            $sampleData = Penduduk::select('nama', 'jenis_kelamin', 'alamat', 'pekerjaan', 'ttl')
                ->limit(5)
                ->get();
            
            foreach ($sampleData as $penduduk) {
                echo sprintf(
                    "- %s | %s | %s | %s | %s\n",
                    $penduduk->nama ?? 'null',
                    $penduduk->jenis_kelamin ?? 'null',
                    $penduduk->alamat ?? 'null',
                    $penduduk->pekerjaan ?? 'null',
                    $penduduk->ttl ?? 'null'
                );
            }
            
            // Gender distribution
            echo "\n5. Gender distribution:\n";
            $lakiLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
            $perempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();
            echo "Laki-laki: " . $lakiLaki . "\n";
            echo "Perempuan: " . $perempuan . "\n";
            
            // Check field values
            echo "\n6. Unique values in jenis_kelamin field:\n";
            $genderValues = Penduduk::select('jenis_kelamin')
                ->distinct()
                ->whereNotNull('jenis_kelamin')
                ->pluck('jenis_kelamin');
            
            foreach ($genderValues as $gender) {
                $count = Penduduk::where('jenis_kelamin', $gender)->count();
                echo "'" . $gender . "': " . $count . " records\n";
            }
            
            // Check alamat data
            echo "\n7. Address data check:\n";
            $addressCount = Penduduk::whereNotNull('alamat')->where('alamat', '!=', '')->count();
            echo "Records with address: " . $addressCount . "\n";
            
            if ($addressCount > 0) {
                echo "\nSample addresses:\n";
                $sampleAddresses = Penduduk::select('alamat')
                    ->whereNotNull('alamat')
                    ->where('alamat', '!=', '')
                    ->limit(10)
                    ->pluck('alamat');
                    
                foreach ($sampleAddresses as $address) {
                    echo "- " . $address . "\n";
                }
            }
        } else {
            echo "❌ No data found in penduduks table\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "\n=== DEBUG COMPLETED ===\n";
