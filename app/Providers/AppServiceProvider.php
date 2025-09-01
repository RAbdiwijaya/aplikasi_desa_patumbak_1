<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Fallback untuk assets di production
        Vite::useStyleTagAttributes(function (string $src, string $url, array $chunk, array $manifest) {
            if ($this->app->isProduction()) {
                return [
                    'rel' => 'stylesheet',
                    'href' => $url,
                    'nonce' => request()->header('X-Nonce'),
                ];
            }
            
            return [];
        });
    }
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
        //
    }
}
