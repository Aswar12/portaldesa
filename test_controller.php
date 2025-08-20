<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Http\Controllers\InfografisController;
use Illuminate\Http\Request;

echo "=== TESTING CONTROLLER RESPONSE ===" . PHP_EOL;

try {
    $controller = new InfografisController();
    $request = new Request();
    
    // Simulate the penduduk method call
    $response = $controller->penduduk();
    
    if ($response instanceof \Illuminate\View\View) {
        $data = $response->getData();
        echo "View data received:" . PHP_EOL;
        echo "- totalPenduduk: " . ($data['totalPenduduk'] ?? 'NOT SET') . PHP_EOL;
        echo "- lakiLaki: " . ($data['lakiLaki'] ?? 'NOT SET') . PHP_EOL;
        echo "- perempuan: " . ($data['perempuan'] ?? 'NOT SET') . PHP_EOL;
        echo "- bayi: " . ($data['bayi'] ?? 'NOT SET') . PHP_EOL;
        echo "- balita: " . ($data['balita'] ?? 'NOT SET') . PHP_EOL;
        echo "- anakAnak: " . ($data['anakAnak'] ?? 'NOT SET') . PHP_EOL;
        echo "- dewasa: " . ($data['dewasa'] ?? 'NOT SET') . PHP_EOL;
        echo "- lansia: " . ($data['lansia'] ?? 'NOT SET') . PHP_EOL;
        echo "- pekerjaanData count: " . (isset($data['pekerjaanData']) ? count($data['pekerjaanData']) : 'NOT SET') . PHP_EOL;
        echo "- rtChartData count: " . (isset($data['rtChartData']) ? count($data['rtChartData']) : 'NOT SET') . PHP_EOL;
    } else {
        echo "Response is not a view: " . get_class($response) . PHP_EOL;
    }
    
} catch (\Exception $e) {
    echo "ERROR in controller: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . PHP_EOL;
    echo "Stack trace:" . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
?>
