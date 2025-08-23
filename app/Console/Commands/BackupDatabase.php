<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup {--path= : Custom backup path} {--filename= : Custom filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting database backup...');

        try {
            // Get database configuration
            $connection = config('database.default');
            $host = config("database.connections.{$connection}.host");
            $port = config("database.connections.{$connection}.port");
            $database = config("database.connections.{$connection}.database");
            $username = config("database.connections.{$connection}.username");
            $password = config("database.connections.{$connection}.password");

            // Generate filename
            $timestamp = Carbon::now()->format('Ymd-His');
            $filename = $this->option('filename') ?: "backup-{$database}-{$timestamp}.sql";
            
            // Set backup path
            $customPath = $this->option('path');
            if ($customPath) {
                $backupPath = rtrim($customPath, '/\\') . DIRECTORY_SEPARATOR . $filename;
            } else {
                $backupPath = base_path($filename);
            }

            // Build mysqldump command
            $command = sprintf(
                'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s > "%s"',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database),
                $backupPath
            );

            // Execute the command
            $this->info("Creating backup: {$filename}");
            $this->info("Backup path: {$backupPath}");
            
            exec($command, $output, $returnVar);

            if ($returnVar === 0) {
                $fileSize = $this->formatBytes(filesize($backupPath));
                $this->info("✓ Database backup completed successfully!");
                $this->info("✓ File: {$backupPath}");
                $this->info("✓ Size: {$fileSize}");
                
                return Command::SUCCESS;
            } else {
                $this->error("✗ Database backup failed!");
                $this->error("Command output: " . implode("\n", $output));
                return Command::FAILURE;
            }

        } catch (\Exception $e) {
            $this->error("✗ An error occurred: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Format bytes to human readable format
     *
     * @param int $size
     * @param int $precision
     * @return string
     */
    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}
