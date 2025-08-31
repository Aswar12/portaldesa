<?php
/**
 * Safe migration script untuk production server
 * Menjalankan migrasi dengan checks keamanan
 */

// Set memory limit and timeout
ini_set('memory_limit', '256M');
set_time_limit(300);

echo "=== Safe APBDes Migration Script ===\n";
echo "Started at: " . date('Y-m-d H:i:s') . "\n\n";

try {
    // Bootstrap Laravel
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    // Check if migration is needed
    echo "1. Checking if migration is needed...\n";
    
    $migrationExists = DB::table('migrations')
        ->where('migration', 'like', '%add_tampil_infografis_to_anggarans_table%')
        ->exists();
    
    if ($migrationExists) {
        echo "   ✅ Migration already exists, skipping...\n";
    } else {
        echo "   ⚠️  Migration needed, checking table structure...\n";
        
        // Check if column already exists
        $columns = DB::select('SHOW COLUMNS FROM anggarans');
        $columnNames = array_column($columns, 'Field');
        
        if (in_array('tampil_infografis', $columnNames)) {
            echo "   ✅ Column already exists, just need to mark migration as done\n";
            
            // Insert migration record manually
            DB::table('migrations')->insert([
                'migration' => '2025_08_31_141722_add_tampil_infografis_to_anggarans_table',
                'batch' => DB::table('migrations')->max('batch') + 1
            ]);
            
            echo "   ✅ Migration record added\n";
        } else {
            echo "   🔧 Adding missing columns...\n";
            
            // Add columns manually with safe SQL
            DB::statement('ALTER TABLE anggarans ADD COLUMN tampil_infografis TINYINT(1) NOT NULL DEFAULT 0 AFTER user_id');
            DB::statement('ALTER TABLE anggarans ADD COLUMN warna_chart VARCHAR(7) NOT NULL DEFAULT "#17a2b8" AFTER tampil_infografis');
            
            // Insert migration record
            DB::table('migrations')->insert([
                'migration' => '2025_08_31_141722_add_tampil_infografis_to_anggarans_table',
                'batch' => DB::table('migrations')->max('batch') + 1
            ]);
            
            echo "   ✅ Columns added successfully\n";
        }
    }

    // Update existing data
    echo "\n2. Updating existing anggaran data...\n";
    $updated = DB::table('anggarans')
        ->where('tampil_infografis', 0)
        ->update(['tampil_infografis' => 1]);
    
    echo "   ✅ Updated $updated records\n";

    // Clear caches
    echo "\n3. Clearing caches...\n";
    if (function_exists('opcache_reset')) {
        opcache_reset();
        echo "   ✅ OPcache cleared\n";
    }
    
    // Clear Laravel caches (if artisan is available)
    $commands = [
        'config:clear',
        'cache:clear',
        'route:clear',
        'view:clear'
    ];
    
    foreach ($commands as $command) {
        try {
            Artisan::call($command);
            echo "   ✅ $command executed\n";
        } catch (Exception $e) {
            echo "   ⚠️  $command failed: " . $e->getMessage() . "\n";
        }
    }

    echo "\n=== Migration completed successfully! ===\n";
    echo "You can now access: https://kadunjaya.kampungku.online/admin/apbdes\n";

} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    
    // Try to rollback if needed
    echo "\nAttempting rollback...\n";
    try {
        // Remove columns if they were added
        DB::statement('ALTER TABLE anggarans DROP COLUMN IF EXISTS warna_chart');
        DB::statement('ALTER TABLE anggarans DROP COLUMN IF EXISTS tampil_infografis');
        echo "✅ Rollback completed\n";
    } catch (Exception $rollbackE) {
        echo "❌ Rollback failed: " . $rollbackE->getMessage() . "\n";
    }
}

echo "\nCompleted at: " . date('Y-m-d H:i:s') . "\n";
?>
