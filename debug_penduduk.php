<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DEBUGGING PENDUDUK DATA ===" . PHP_EOL;
echo "Total Penduduk: " . App\Models\Penduduk::count() . PHP_EOL;

if (App\Models\Penduduk::count() > 0) {
    echo "First 3 records:" . PHP_EOL;
    $sample = App\Models\Penduduk::take(3)->get(['nama', 'jenis_kelamin', 'ttl']);
    foreach ($sample as $p) {
        echo "- " . $p->nama . " | " . ($p->jenis_kelamin ?? 'NULL') . " | " . ($p->ttl ?? 'NULL') . PHP_EOL;
    }
    
    echo PHP_EOL . "Gender distribution:" . PHP_EOL;
    echo "Laki-laki: " . App\Models\Penduduk::where('jenis_kelamin', 'Laki-laki')->count() . PHP_EOL;
    echo "Perempuan: " . App\Models\Penduduk::where('jenis_kelamin', 'Perempuan')->count() . PHP_EOL;
} else {
    echo "No penduduk data found in database!" . PHP_EOL;
}
?>
