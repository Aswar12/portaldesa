<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TESTING INFOGRAFIS CONTROLLER LOGIC ===" . PHP_EOL;

try {
    // Data statistik penduduk
    $totalPenduduk = App\Models\Penduduk::count();
    echo "Total penduduk: " . $totalPenduduk . PHP_EOL;
    
    $lakiLaki = App\Models\Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
    $perempuan = App\Models\Penduduk::where('jenis_kelamin', 'Perempuan')->count();
    echo "Laki-laki: " . $lakiLaki . ", Perempuan: " . $perempuan . PHP_EOL;
    
    if ($totalPenduduk == 0) {
        echo "Using sample data (totalPenduduk is 0)" . PHP_EOL;
    } else {
        echo "Using real data from database" . PHP_EOL;
        
        // Test age calculations
        echo "Testing age calculations:" . PHP_EOL;
        $bayi = App\Models\Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) < 1')->count();
        echo "Bayi: " . $bayi . PHP_EOL;
        
        $balita = App\Models\Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 1 AND 4')->count();
        echo "Balita: " . $balita . PHP_EOL;
        
        $anakAnak = App\Models\Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 5 AND 17')->count();
        echo "Anak-anak: " . $anakAnak . PHP_EOL;
        
        $dewasa = App\Models\Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 18 AND 59')->count();
        echo "Dewasa: " . $dewasa . PHP_EOL;
        
        $lansia = App\Models\Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, ttl, CURDATE()) >= 60')->count();
        echo "Lansia: " . $lansia . PHP_EOL;
        
        echo "Total age groups: " . ($bayi + $balita + $anakAnak + $dewasa + $lansia) . PHP_EOL;
        
        // Test pekerjaan data
        echo "Testing pekerjaan data:" . PHP_EOL;
        $pekerjaanData = App\Models\Penduduk::selectRaw('pekerjaan, COUNT(*) as jumlah')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '')
            ->groupBy('pekerjaan')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();
            
        foreach($pekerjaanData as $p) {
            echo "- " . $p->pekerjaan . ": " . $p->jumlah . PHP_EOL;
        }
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . PHP_EOL;
}
?>
