<?php

/**
 * SCRIPT SEMENTARA - hanya untuk setup awal server InfinityFree.
 *
 * Upload ke htdocs/ (SEJAJAR dengan index.php, bukan di dalam core/),
 * jalankan tiap action lewat browser, lalu HAPUS FILE INI DARI SERVER
 * begitu semua langkah selesai. Jangan dibiarkan online.
 *
 * Dilindungi token supaya orang lain yang kebetulan tahu URL-nya tidak
 * bisa memicu migrate/seed. Token diambil dari DEPLOY_SECRET di .env.
 *
 * Cara pakai (ganti TOKEN dengan isi DEPLOY_SECRET di .env production):
 *   https://domainmu/deploy-helper.php?token=TOKEN&action=status
 *   https://domainmu/deploy-helper.php?token=TOKEN&action=migrate
 *   https://domainmu/deploy-helper.php?token=TOKEN&action=storage-link
 *   https://domainmu/deploy-helper.php?token=TOKEN&action=seed-admin
 *   https://domainmu/deploy-helper.php?token=TOKEN&action=optimize
 */

header('Content-Type: text/plain; charset=utf-8');

try {
    require __DIR__.'/core/vendor/autoload.php';
    $app = require_once __DIR__.'/core/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
} catch (\Throwable $e) {
    http_response_code(500);
    echo "Gagal bootstrap Laravel. Cek lagi path 'core/' dan .env.\n";
    echo "Pesan: " . $e->getMessage() . "\n";
    exit;
}

$secret = (string) env('DEPLOY_SECRET', '');
$given = (string) ($_GET['token'] ?? '');

if ($secret === '' || !hash_equals($secret, $given)) {
    http_response_code(403);
    echo "Token salah, kosong, atau DEPLOY_SECRET belum diset di .env.\n";
    exit;
}

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'status':
            echo "PHP: " . PHP_VERSION . "\n";
            echo "App env: " . app()->environment() . "\n";
            echo "Debug mode: " . (config('app.debug') ? 'ON (ubah ke false!)' : 'off') . "\n";
            try {
                \Illuminate\Support\Facades\DB::connection()->getPdo();
                echo "DB: terkoneksi ke " . config('database.connections.mysql.database') . "\n";
            } catch (\Throwable $e) {
                echo "DB: GAGAL terkoneksi - " . $e->getMessage() . "\n";
            }
            break;

        case 'migrate':
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            echo \Illuminate\Support\Facades\Artisan::output();
            break;

        case 'migrate-status':
            \Illuminate\Support\Facades\Artisan::call('migrate:status');
            echo \Illuminate\Support\Facades\Artisan::output();
            break;

        case 'seed-admin':
            \Illuminate\Support\Facades\Artisan::call('db:seed', [
                '--class' => 'UserSeeders',
                '--force' => true,
            ]);
            echo \Illuminate\Support\Facades\Artisan::output();
            echo "\nIngat: hapus ADMIN_EMAIL/ADMIN_PASSWORD dari .env setelah ini.\n";
            break;

        case 'storage-link':
            $target = __DIR__ . '/core/storage/app/public';
            $link = __DIR__ . '/storage';

            if (file_exists($link)) {
                echo "htdocs/storage sudah ada (file/folder/symlink). Hapus dulu manual kalau mau buat ulang.\n";
                break;
            }

            if (function_exists('symlink') && @symlink($target, $link)) {
                echo "Symlink berhasil: htdocs/storage -> core/storage/app/public\n";
            } else {
                echo "symlink() gagal atau tidak diizinkan di server ini.\n";
                echo "Fallback: salin manual isi folder core/storage/app/public\n";
                echo "ke folder baru htdocs/storage lewat File Manager, dan ulangi\n";
                echo "proses itu setiap kali ada upload gambar baru (kurang ideal,\n";
                echo "lihat docs/deploy-infinityfree.md bagian troubleshooting).\n";
            }
            break;

        case 'optimize':
            \Illuminate\Support\Facades\Artisan::call('config:cache');
            \Illuminate\Support\Facades\Artisan::call('route:cache');
            \Illuminate\Support\Facades\Artisan::call('view:cache');
            echo \Illuminate\Support\Facades\Artisan::output();
            break;

        case 'clear':
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            echo \Illuminate\Support\Facades\Artisan::output();
            break;

        default:
            echo "Action tidak dikenal. Pilihan: status, migrate, migrate-status, storage-link, seed-admin, optimize, clear\n";
    }
} catch (\Throwable $e) {
    http_response_code(500);
    echo "Error saat menjalankan action '{$action}':\n" . $e->getMessage() . "\n";
}

echo "\n--- SELESAI. Kalau sudah tidak dipakai lagi, HAPUS FILE INI DARI SERVER SEKARANG. ---\n";
