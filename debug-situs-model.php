<?php
/**
 * Fix AppServiceProvider Database Connection Issues
 * Upload dan jalankan file ini untuk mengecek status database
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Database Connection Diagnostics</h1>";
echo "<hr>";

// 1. Test basic database connection
echo "<h2>1. Database Connection Test</h2>";
try {
    // Laravel bootstrap
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    
    // Test connection
    $dbname = DB::connection()->getDatabaseName();
    echo "✅ Database connected: <strong>$dbname</strong><br>";
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    echo "<strong>Fix:</strong> Check .env database configuration<br>";
    echo "<hr>";
    exit;
}

// 2. Check if situses table exists
echo "<h2>2. Situses Table Check</h2>";
try {
    $tables = DB::select("SHOW TABLES LIKE 'situses'");
    if (count($tables) > 0) {
        echo "✅ Situses table exists<br>";
        
        // Check columns
        $columns = DB::select('SHOW COLUMNS FROM situses');
        echo "<h3>Table Structure:</h3><ul>";
        foreach ($columns as $column) {
            echo "<li>{$column->Field} ({$column->Type})</li>";
        }
        echo "</ul>";
        
        // Check data
        $count = DB::table('situses')->count();
        echo "📊 Records count: <strong>$count</strong><br>";
        
        if ($count > 0) {
            $firstRecord = DB::table('situses')->first();
            echo "<h3>First Record:</h3>";
            echo "<pre>" . print_r($firstRecord, true) . "</pre>";
        } else {
            echo "<strong>⚠️ No data found in situses table</strong><br>";
            echo "Need to insert default data<br>";
        }
        
    } else {
        echo "❌ Situses table does not exist<br>";
        echo "<strong>Fix:</strong> Need to run migration<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking situses table: " . $e->getMessage() . "<br>";
}

// 3. Test Situs model
echo "<h2>3. Situs Model Test</h2>";
try {
    $situs = App\Models\Situs::first();
    if ($situs) {
        echo "✅ Situs model working<br>";
        echo "📝 Data: " . ($situs->nm_desa ?? 'No nm_desa field') . "<br>";
    } else {
        echo "⚠️ No data in Situs model<br>";
    }
} catch (Exception $e) {
    echo "❌ Situs model error: " . $e->getMessage() . "<br>";
}

// 4. Create default situs data if needed
echo "<h2>4. Fix Missing Data</h2>";
try {
    $count = DB::table('situses')->count();
    if ($count == 0) {
        echo "🔧 Inserting default situs data...<br>";
        
        DB::table('situses')->insert([
            'nm_desa' => 'Kadun Jaya',
            'alamat' => 'Alamat Desa',
            'telp' => '021-xxx-xxx',
            'email' => 'admin@kadunjaya.kampungku.online',
            'website' => 'https://kadunjaya.kampungku.online',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        echo "✅ Default situs data created<br>";
    } else {
        echo "✅ Situs data already exists<br>";
    }
} catch (Exception $e) {
    echo "❌ Error creating default data: " . $e->getMessage() . "<br>";
}

// 5. Test AppServiceProvider logic
echo "<h2>5. AppServiceProvider Logic Test</h2>";
try {
    if (DB::connection()->getDatabaseName()) {
        $nm_desa = App\Models\Situs::first()?->nm_desa ?? 'Portal Desa Kadun Jaya';
        echo "✅ AppServiceProvider logic working<br>";
        echo "🏠 Village Name: <strong>$nm_desa</strong><br>";
    }
} catch (Exception $e) {
    echo "❌ AppServiceProvider logic error: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>✅ Summary</h2>";
echo "<p>If all checks pass, your AppServiceProvider should work correctly.</p>";
echo "<p>If there are errors, fix them based on the messages above.</p>";
echo "<p><strong>After fixing, delete this file for security.</strong></p>";
?>
