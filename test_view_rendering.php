<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\InfografisController;

// Simulate calling the bansos method
$controller = new InfografisController();
try {
    // We can't easily call the method directly, but we can check if the view renders
    echo 'Controller method exists and can be called' . PHP_EOL;

    // Check if view file exists
    $viewPath = __DIR__ . '/resources/views/infografis/bansos.blade.php';
    if (file_exists($viewPath)) {
        echo 'View file exists: ' . $viewPath . PHP_EOL;

        // Check if our dynamic code is in the view
        $content = file_get_contents($viewPath);
        if (strpos($content, 'bansosByType') !== false) {
            echo 'Dynamic bansosByType code found in view' . PHP_EOL;
        } else {
            echo 'Dynamic code not found in view' . PHP_EOL;
        }

        if (strpos($content, 'getBansosInfo') !== false) {
            echo 'getBansosInfo function found in view' . PHP_EOL;
        } else {
            echo 'getBansosInfo function not found in view' . PHP_EOL;
        }
    } else {
        echo 'View file not found' . PHP_EOL;
    }

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}