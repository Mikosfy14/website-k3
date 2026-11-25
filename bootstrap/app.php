<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
            'prevent.back' => \App\Http\Middleware\PreventBackHistory::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Deploy InfinityFree (dan hosting sejenis tanpa akses di luar htdocs/)
// pakai struktur htdocs/ + htdocs/core/ (lihat docs/deploy-infinityfree.md):
// semua kode Laravel ada di core/, tapi folder public/ TIDAK ikut dipindah
// ke core/public/ - isinya (build/, images/, dll.) ditaruh langsung di
// htdocs/, satu level di atas core/. Default Laravel mengasumsikan
// public_path() = base_path('public') = core/public, yang di struktur
// ini tidak ada - itu bikin Vite gagal menemukan manifest.json.
//
// Dideteksi dari ada/tidaknya folder 'public' di lokasi biasa, supaya
// development lokal (struktur standar, public/ di root project) tidak
// terpengaruh sama sekali.
if (!is_dir(__DIR__ . '/../public')) {
    $app->usePublicPath(dirname(__DIR__, 2));
}

return $app;
