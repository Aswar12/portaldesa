<?php
/**
 * Insert Default Situses Data
 * Jalankan setelah database connection sudah benar
 */

echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; }
.success { color: green; font-weight: bold; }
.error { color: red; font-weight: bold; }
</style>";

echo "<h1>🏠 Setup Default Situses Data</h1>";
echo "<hr>";

// Database configuration (update these with your actual config)
$configs = [
    [
        'host' => 'localhost',
        'dbname' => 'u818788320_portaldesa',
        'username' => 'u818788320_portaldesa',
        'password' => 'your_password_here', // UPDATE THIS!
    ],
    [
        'host' => '127.0.0.1',
        'dbname' => 'u818788320_portaldesa', 
        'username' => 'u818788320_portaldesa',
        'password' => 'your_password_here', // UPDATE THIS!
    ]
];

$connected = false;
$pdo = null;

// Try to connect with different configurations
foreach ($configs as $config) {
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        echo "<span class='success'>✅ Connected to database: {$config['dbname']}</span><br>";
        $connected = true;
        break;
    } catch (PDOException $e) {
        echo "<span class='error'>❌ Connection failed with {$config['host']}: " . $e->getMessage() . "</span><br>";
    }
}

if (!$connected) {
    echo "<span class='error'>❌ Could not connect to database. Please check your credentials.</span><br>";
    exit;
}

try {
    // Check if situses table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'situses'");
    $tableExists = $stmt->fetchAll();
    
    if (count($tableExists) === 0) {
        echo "<span class='error'>❌ situses table does not exist. Need to create it first.</span><br>";
        
        // Create situses table
        $createTable = "
        CREATE TABLE `situses` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `nm_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `alamat` text COLLATE utf8mb4_unicode_ci,
            `telp` varchar(255) COLLATE utf8mb4_unicode_ci,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci,
            `website` varchar(255) COLLATE utf8mb4_unicode_ci,
            `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        $pdo->exec($createTable);
        echo "<span class='success'>✅ situses table created successfully</span><br>";
    } else {
        echo "<span class='success'>✅ situses table exists</span><br>";
    }
    
    // Check if data already exists
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM situses");
    $count = $stmt->fetch()['count'];
    
    if ($count > 0) {
        echo "<span class='success'>✅ situses table already has $count record(s)</span><br>";
        
        // Show existing data
        $stmt = $pdo->query("SELECT * FROM situses LIMIT 1");
        $existing = $stmt->fetch();
        echo "<h3>Current Data:</h3>";
        echo "<pre>" . print_r($existing, true) . "</pre>";
        
    } else {
        echo "<span class='success'>🔧 Inserting default situses data...</span><br>";
        
        // Insert default data
        $insertData = "
        INSERT INTO situses (nm_desa, alamat, telp, email, website, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ";
        
        $stmt = $pdo->prepare($insertData);
        $result = $stmt->execute([
            'Kadun Jaya',
            'Jl. Raya Kadun Jaya, Kecamatan Kadun Jaya',
            '021-xxx-xxxx',
            'admin@kadunjaya.kampungku.online', 
            'https://kadunjaya.kampungku.online'
        ]);
        
        if ($result) {
            echo "<span class='success'>✅ Default situses data inserted successfully!</span><br>";
            
            // Verify inserted data
            $stmt = $pdo->query("SELECT * FROM situses WHERE nm_desa = 'Kadun Jaya'");
            $inserted = $stmt->fetch();
            echo "<h3>Inserted Data:</h3>";
            echo "<pre>" . print_r($inserted, true) . "</pre>";
        } else {
            echo "<span class='error'>❌ Failed to insert default data</span><br>";
        }
    }
    
    // Test the AppServiceProvider logic
    echo "<h3>Testing AppServiceProvider Logic:</h3>";
    $stmt = $pdo->query("SELECT nm_desa FROM situses LIMIT 1");
    $situs = $stmt->fetch();
    
    if ($situs) {
        $nm_desa = $situs['nm_desa'] ?? 'Portal Desa Kadun Jaya';
        echo "<span class='success'>✅ Village name for AppServiceProvider: $nm_desa</span><br>";
    } else {
        echo "<span class='error'>❌ Could not retrieve village name</span><br>";
    }
    
} catch (PDOException $e) {
    echo "<span class='error'>❌ Database error: " . $e->getMessage() . "</span><br>";
} catch (Exception $e) {
    echo "<span class='error'>❌ General error: " . $e->getMessage() . "</span><br>";
}

echo "<hr>";
echo "<h3>✅ Next Steps:</h3>";
echo "<ol>";
echo "<li>Make sure your .env file has the correct database configuration</li>";
echo "<li>Clear Laravel cache if possible: <code>php artisan config:clear</code></li>";
echo "<li>Test your website - AppServiceProvider should now work</li>";
echo "<li><strong>Delete this file for security</strong></li>";
echo "</ol>";

echo "<p><strong>⚠️ SECURITY WARNING: Delete this file after use!</strong></p>";
?>
