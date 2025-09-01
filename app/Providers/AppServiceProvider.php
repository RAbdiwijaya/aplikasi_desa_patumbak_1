<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;

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
        // Hanya ada SATU method boot()
        // Pastikan tidak ada duplikasi method boot() lainnya
        
        // Contoh konfigurasi Vite untuk production (jika diperlukan)
        Vite::useStyleTagAttributes(function (string $src, string $url, array $chunk, array $manifest) {
            if ($this->app->isProduction()) {
                return [
                    'rel' => 'stylesheet',
                    'href' => $url,
                ];
            }
            return [];
        });
    }
}
