<?php
/**
 * Debug script untuk mengecek status APBDes di server hosting
 * Jalankan file ini di browser untuk diagnostic
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>APBDes Debug Report</h1>";
echo "<hr>";

try {
    // Check Laravel bootstrap
    echo "<h2>1. Laravel Bootstrap Check</h2>";
    if (file_exists(__DIR__ . '/bootstrap/app.php')) {
        echo "✅ Bootstrap file exists<br>";
        require_once __DIR__ . '/bootstrap/app.php';
        echo "✅ Bootstrap loaded successfully<br>";
    } else {
        echo "❌ Bootstrap file not found<br>";
        exit;
    }

    // Check database connection
    echo "<h2>2. Database Connection Check</h2>";
    try {
        $app = require_once __DIR__ . '/bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        $db = DB::connection();
        $db->getPdo();
        echo "✅ Database connection successful<br>";
        
        // Check if anggarans table exists
        $tables = DB::select('SHOW TABLES LIKE "anggarans"');
        if (count($tables) > 0) {
            echo "✅ Anggarans table exists<br>";
            
            // Check columns
            $columns = DB::select('SHOW COLUMNS FROM anggarans');
            $columnNames = array_column($columns, 'Field');
            
            echo "<h3>Table Columns:</h3><ul>";
            foreach ($columnNames as $column) {
                echo "<li>$column</li>";
            }
            echo "</ul>";
            
            // Check if tampil_infografis column exists
            if (in_array('tampil_infografis', $columnNames)) {
                echo "✅ tampil_infografis column exists<br>";
            } else {
                echo "❌ tampil_infografis column NOT exists - MIGRATION NEEDED!<br>";
            }
            
            // Check data count
            $count = DB::table('anggarans')->count();
            echo "📊 Total anggaran records: $count<br>";
            
        } else {
            echo "❌ Anggarans table does not exist<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    }

    // Check migrations status
    echo "<h2>3. Migration Status Check</h2>";
    try {
        $migrations = DB::table('migrations')->orderBy('batch', 'desc')->get();
        echo "<h3>Recent migrations:</h3><ul>";
        foreach ($migrations->take(10) as $migration) {
            echo "<li>Batch {$migration->batch}: {$migration->migration}</li>";
        }
        echo "</ul>";
        
        // Check specific migration
        $apbdesMigration = DB::table('migrations')
            ->where('migration', 'like', '%add_tampil_infografis_to_anggarans_table%')
            ->first();
            
        if ($apbdesMigration) {
            echo "✅ APBDes fix migration found (Batch: {$apbdesMigration->batch})<br>";
        } else {
            echo "❌ APBDes fix migration NOT found - NEED TO RUN MIGRATION!<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Migration check failed: " . $e->getMessage() . "<br>";
    }

    // Check file permissions
    echo "<h2>4. File Permissions Check</h2>";
    $paths = [
        'storage/logs' => 'storage/logs',
        'bootstrap/cache' => 'bootstrap/cache',
        'storage/framework' => 'storage/framework'
    ];
    
    foreach ($paths as $path => $label) {
        if (is_writable($path)) {
            echo "✅ $label is writable<br>";
        } else {
            echo "❌ $label is NOT writable<br>";
        }
    }

    // Check environment
    echo "<h2>5. Environment Check</h2>";
    echo "APP_ENV: " . env('APP_ENV', 'not set') . "<br>";
    echo "APP_DEBUG: " . (env('APP_DEBUG') ? 'true' : 'false') . "<br>";
    echo "DB_CONNECTION: " . env('DB_CONNECTION', 'not set') . "<br>";
    echo "DB_HOST: " . env('DB_HOST', 'not set') . "<br>";
    echo "DB_DATABASE: " . env('DB_DATABASE', 'not set') . "<br>";

} catch (Exception $e) {
    echo "<h2>❌ FATAL ERROR:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr>";
echo "<p>Debug completed at: " . date('Y-m-d H:i:s') . "</p>";
?>
