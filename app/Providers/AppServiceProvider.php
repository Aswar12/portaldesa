<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
            $nm_desa = Situs::first()?->nm_desa ?? 'Nama Desa';
            View::share('nm_desa', $nm_desa);
        }
    }
}
