<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class HttpsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }
        
        // Handle Cloudflare forwarded headers
        if (request()->header('CF-Visitor')) {
            $cfVisitor = json_decode(request()->header('CF-Visitor'), true);
            if (isset($cfVisitor['scheme']) && $cfVisitor['scheme'] === 'https') {
                URL::forceScheme('https');
            }
        }
        
        // Handle X-Forwarded-Proto header
        if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}
