<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\InfografisController;

echo "=== TESTING BANSOS CONTROLLER OUTPUT ===" . PHP_EOL;

$controller = new InfografisController();

// Capture the view data by simulating the method
$method = new ReflectionMethod($controller, 'bansos');
$method->setAccessible(true);

try {
    $result = $controller->bansos();
    
    if ($result instanceof \Illuminate\View\View) {
        $data = $result->getData();
        
        echo "View variables:" . PHP_EOL;
        echo "- totalPenerima: " . ($data['totalPenerima'] ?? 'MISSING') . PHP_EOL;
        echo "- bansosByType: " . (isset($data['bansosByType']) ? 'EXISTS' : 'MISSING') . PHP_EOL;
        echo "- bansosInfo: " . (isset($data['bansosInfo']) ? 'EXISTS' : 'MISSING') . PHP_EOL;
        
        if (isset($data['bansosByType'])) {
            echo PHP_EOL . "BansosByType contents:" . PHP_EOL;
            foreach ($data['bansosByType'] as $jenis => $jumlah) {
                echo "- {$jenis}: {$jumlah}" . PHP_EOL;
            }
        }
        
        if (isset($data['bansosInfo'])) {
            echo PHP_EOL . "BansosInfo keys available:" . PHP_EOL;
            foreach (array_keys($data['bansosInfo']) as $key) {
                echo "- {$key}" . PHP_EOL;
            }
        }
        
        echo PHP_EOL . "Cards that should be displayed:" . PHP_EOL;
        if (isset($data['bansosByType']) && isset($data['bansosInfo'])) {
            foreach($data['bansosByType'] as $jenis => $jumlah) {
                if($jumlah > 0) {
                    $info = $data['bansosInfo'][$jenis] ?? ['desc' => 'Bantuan Sosial'];
                    echo "✅ Card: {$jenis} - {$jumlah} penerima - {$info['desc']}" . PHP_EOL;
                }
            }
        }
        
    } else {
        echo "ERROR: Controller did not return a view" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo "Stack trace:" . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}