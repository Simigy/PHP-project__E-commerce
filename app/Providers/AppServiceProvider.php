<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;

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
        // Force SSL if enabled in config
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        
        // Handle asset URLs for subdirectory installations
        $baseUrl = Request::root();
        URL::forceRootUrl($baseUrl);

        // Enable debugging in local environment
        if (app()->environment('local')) {
            Log::info('URL Configuration', [
                'root_url' => URL::to('/'),
                'asset_url' => config('app.asset_url'),
                'current_url' => request()->url(),
                'base_path' => base_path(),
                'public_path' => public_path()
            ]);
        }

        Paginator::useBootstrap();
        $this->app['router']->aliasMiddleware('is_admin', \App\Http\Middleware\IsAdmin::class);
    }
}
