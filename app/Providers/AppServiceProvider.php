<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Situs;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        // Share nm_desa ke semua view, hanya jika tidak running di console
        if (!$this->app->runningInConsole()) {
            $this->shareVillageData();
        }
    }

    /**
     * Share village data to all views with proper error handling
     */
    private function shareVillageData()
    {
        $nm_desa = 'Portal Desa Kadun Jaya'; // Default fallback
        
        try {
            // Check if database connection is available
            if ($this->isDatabaseAvailable()) {
                // Check if situses table exists
                if ($this->tableExists('situses')) {
                    $situs = \App\Models\Situs::first();
                    if ($situs && isset($situs->nm_desa)) {
                        $nm_desa = $situs->nm_desa;
                    }
                }
            }
        } catch (\Throwable $e) {
            // Log error in development environment
            if (config('app.debug')) {
                \Log::warning('Failed to load village data in AppServiceProvider', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
            }
        }
        
        View::share('nm_desa', $nm_desa);
    }

    /**
     * Check if database is available
     */
    private function isDatabaseAvailable(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Check if a table exists in the database
     */
    private function tableExists(string $table): bool
    {
        try {
            return \Schema::hasTable($table);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
