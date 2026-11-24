<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Pagination\Paginator::useBootstrap();

        // Batasi panjang default kolom string() tanpa panjang eksplisit
        // ke 191 karakter. Perlu untuk MySQL yang index key length-nya
        // terbatas (utf8mb4 = 4 byte/karakter, 255*4=1020 byte > limit
        // server) - migrasi bawaan Laravel (password_reset_tokens dkk)
        // pakai string() tanpa panjang eksplisit untuk kolom yang di-index.
        SchemaBuilder::defaultStringLength(191);
    }
}
