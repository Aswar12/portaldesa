<?php
/**
 * Database Connection Test untuk Server Hosting
 * Upload file ini ke root directory dan akses via browser
 */

echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; }
.success { color: green; font-weight: bold; }
.error { color: red; font-weight: bold; }
.warning { color: orange; font-weight: bold; }
.info { color: blue; }
pre { background: #f5f5f5; padding: 10px; border: 1px solid #ddd; }
</style>";

echo "<h1>🔍 Database Connection Diagnostics</h1>";
echo "<p>Server: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";
echo "<hr>";

// Test 1: Basic PHP MySQL Extension
echo "<h2>1. PHP MySQL Extensions</h2>";
if (extension_loaded('pdo_mysql')) {
    echo "<span class='success'>✅ PDO MySQL extension loaded</span><br>";
} else {
    echo "<span class='error'>❌ PDO MySQL extension NOT loaded</span><br>";
}

if (extension_loaded('mysqli')) {
    echo "<span class='success'>✅ MySQLi extension loaded</span><br>";
} else {
    echo "<span class='error'>❌ MySQLi extension NOT loaded</span><br>";
}

// Test 2: Read .env file
echo "<h2>2. Environment Configuration</h2>";
if (file_exists('.env')) {
    echo "<span class='success'>✅ .env file found</span><br>";
    $env_content = file_get_contents('.env');
    $env_lines = explode("\n", $env_content);
    $db_config = [];
    
    foreach ($env_lines as $line) {
        if (strpos($line, 'DB_') === 0) {
            $parts = explode('=', $line, 2);
            if (count($parts) == 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                $db_config[$key] = $value;
                
                // Mask password for display
                if ($key === 'DB_PASSWORD') {
                    $display_value = str_repeat('*', strlen($value));
                } else {
                    $display_value = $value;
                }
                echo "<span class='info'>$key = $display_value</span><br>";
            }
        }
    }
} else {
    echo "<span class='error'>❌ .env file not found</span><br>";
    echo "<span class='warning'>Create .env file with database configuration</span><br>";
    exit;
}

// Test 3: Database Connection with different configurations
echo "<h2>3. Database Connection Tests</h2>";

// Configuration attempts
$configs = [
    [
        'host' => $db_config['DB_HOST'] ?? 'localhost',
        'dbname' => $db_config['DB_DATABASE'] ?? '',
        'username' => $db_config['DB_USERNAME'] ?? '',
        'password' => $db_config['DB_PASSWORD'] ?? '',
        'label' => 'From .env file'
    ],
    [
        'host' => 'localhost',
        'dbname' => 'u818788320_portaldesa',
        'username' => 'u818788320_portaldesa',
        'password' => $db_config['DB_PASSWORD'] ?? '',
        'label' => 'Standard cPanel format'
    ],
    [
        'host' => '127.0.0.1',
        'dbname' => 'u818788320_portaldesa',
        'username' => 'u818788320_portaldesa',
        'password' => $db_config['DB_PASSWORD'] ?? '',
        'label' => 'IP localhost'
    ]
];

$connected = false;
$working_config = null;

foreach ($configs as $config) {
    echo "<h3>Testing: {$config['label']}</h3>";
    echo "<span class='info'>Host: {$config['host']}</span><br>";
    echo "<span class='info'>Database: {$config['dbname']}</span><br>";
    echo "<span class='info'>Username: {$config['username']}</span><br>";
    
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        echo "<span class='success'>✅ Connection successful!</span><br>";
        
        // Test query
        $stmt = $pdo->query("SELECT DATABASE() as db_name");
        $result = $stmt->fetch();
        echo "<span class='success'>✅ Database name: {$result['db_name']}</span><br>";
        
        // Check tables
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll();
        echo "<span class='info'>📊 Tables found: " . count($tables) . "</span><br>";
        
        if (count($tables) > 0) {
            echo "<details><summary>View Tables</summary><ul>";
            foreach ($tables as $table) {
                $table_name = array_values($table)[0];
                echo "<li>$table_name</li>";
            }
            echo "</ul></details>";
        }
        
        $connected = true;
        $working_config = $config;
        break;
        
    } catch (PDOException $e) {
        echo "<span class='error'>❌ Connection failed: " . $e->getMessage() . "</span><br>";
    }
    echo "<br>";
}

// Test 4: Generate correct .env configuration
if ($connected && $working_config) {
    echo "<h2>4. ✅ Correct Configuration Found</h2>";
    echo "<h3>Update your .env file with these settings:</h3>";
    echo "<pre>";
    echo "DB_CONNECTION=mysql\n";
    echo "DB_HOST={$working_config['host']}\n";
    echo "DB_PORT=3306\n";
    echo "DB_DATABASE={$working_config['dbname']}\n";
    echo "DB_USERNAME={$working_config['username']}\n";
    echo "DB_PASSWORD={$working_config['password']}\n";
    echo "</pre>";
    
    // Test situses table
    echo "<h3>Testing situses table:</h3>";
    try {
        $dsn = "mysql:host={$working_config['host']};dbname={$working_config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $working_config['username'], $working_config['password']);
        
        // Check if situses table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'situses'");
        $table_exists = $stmt->fetchAll();
        
        if (count($table_exists) > 0) {
            echo "<span class='success'>✅ situses table exists</span><br>";
            
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM situses");
            $count = $stmt->fetch()['count'];
            echo "<span class='info'>📊 Records in situses: $count</span><br>";
            
            if ($count > 0) {
                $stmt = $pdo->query("SELECT * FROM situses LIMIT 1");
                $record = $stmt->fetch();
                echo "<span class='success'>✅ Sample data:</span><br>";
                echo "<pre>" . print_r($record, true) . "</pre>";
            } else {
                echo "<span class='warning'>⚠️ situses table is empty</span><br>";
                echo "<span class='info'>Need to insert default data</span><br>";
            }
        } else {
            echo "<span class='error'>❌ situses table does not exist</span><br>";
            echo "<span class='warning'>Need to run migrations or import database</span><br>";
        }
        
    } catch (PDOException $e) {
        echo "<span class='error'>❌ Error checking situses: " . $e->getMessage() . "</span><br>";
    }
    
} else {
    echo "<h2>4. ❌ No Working Configuration Found</h2>";
    echo "<h3>Possible Issues:</h3>";
    echo "<ul>";
    echo "<li>Database hasn't been created in cPanel</li>";
    echo "<li>Database user hasn't been created</li>";
    echo "<li>User not assigned to database</li>";
    echo "<li>Wrong password</li>";
    echo "<li>Database server restrictions</li>";
    echo "</ul>";
    
    echo "<h3>Steps to Fix:</h3>";
    echo "<ol>";
    echo "<li>Login to cPanel</li>";
    echo "<li>Go to MySQL Databases</li>";
    echo "<li>Create database: portaldesa (becomes u818788320_portaldesa)</li>";
    echo "<li>Create user: portaldesa (becomes u818788320_portaldesa)</li>";
    echo "<li>Set strong password</li>";
    echo "<li>Add user to database with ALL PRIVILEGES</li>";
    echo "<li>Update .env file with correct credentials</li>";
    echo "</ol>";
}

echo "<hr>";
echo "<p><strong>⚠️ SECURITY WARNING: Delete this file after use!</strong></p>";
echo "<p>File: " . __FILE__ . "</p>";
?>
