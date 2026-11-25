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

// Diagnostik tanpa token - TIDAK menampilkan isi secret, cuma panjang
// karakternya, supaya bisa dicek apakah .env terbaca & token cocok
// tanpa membocorkan nilai sebenarnya ke publik.
if (($_GET['action'] ?? '') === 'diag') {
    echo "APP_KEY terbaca: " . (env('APP_KEY') ? 'ya' : 'TIDAK') . "\n";
    echo "DEPLOY_SECRET panjang: " . strlen($secret) . " karakter" . ($secret === '' ? ' (KOSONG - .env gagal terbaca atau baris ini tidak ada)' : '') . "\n";
    echo "Token yang kamu kirim panjang: " . strlen($given) . " karakter\n";
    echo "Cocok persis: " . (hash_equals($secret, $given) ? 'YA' : 'TIDAK') . "\n";
    exit;
}

if ($secret === '' || !hash_equals($secret, $given)) {
    http_response_code(403);
    echo "Token salah, kosong, atau DEPLOY_SECRET belum diset di .env.\n";
    exit;
}

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'media-diag':
            $path = $_GET['path'] ?? '';
            if ($path === '') {
                echo "Tambahkan &path=jalur-mitigasi/namafile.jpg di URL.\n";
                break;
            }

            echo "Path yang dicek: {$path}\n\n";

            $routeExists = \Illuminate\Support\Facades\Route::has('media.show');
            echo "Route 'media.show' terdaftar: " . ($routeExists ? 'YA' : 'TIDAK (routes/web.php belum terupdate di server)') . "\n\n";

            $disk = \Illuminate\Support\Facades\Storage::disk('public');
            $absolutePath = $disk->path($path);
            echo "Absolute path yang dicek Laravel: {$absolutePath}\n";
            echo "Storage::disk('public')->exists(): " . ($disk->exists($path) ? 'YA' : 'TIDAK') . "\n";
            echo "PHP file_exists() langsung: " . (file_exists($absolutePath) ? 'YA' : 'TIDAK') . "\n";
            echo "PHP is_readable() langsung: " . (is_readable($absolutePath) ? 'YA' : 'TIDAK') . "\n";

            $dir = dirname($absolutePath);
            echo "\nFolder induk: {$dir}\n";
            echo "Folder induk ada: " . (is_dir($dir) ? 'YA' : 'TIDAK') . "\n";
            if (is_dir($dir)) {
                $files = @scandir($dir) ?: [];
                $files = array_values(array_diff($files, ['.', '..']));
                echo "Isi folder (" . count($files) . " item), 10 pertama:\n";
                foreach (array_slice($files, 0, 10) as $f) {
                    echo "  - {$f}\n";
                }
            }
            break;

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

        // Dipakai SEKALI kalau migrate gagal di tengah jalan (MySQL tidak
        // membungkus CREATE TABLE dalam transaksi, jadi tabel dari migrasi
        // yang gagal bisa sudah fisik ada walau Laravel belum mencatatnya
        // sebagai "sudah jalan"). Ini hanya menghapus tabel KOSONG dari
        // migrasi pertama (users/password_reset_tokens/sessions) supaya
        // 'migrate' bisa dicoba ulang dari awal dengan bersih.
        case 'reset-first-migration':
            $tables = ['sessions', 'password_reset_tokens', 'users'];
            foreach ($tables as $t) {
                \Illuminate\Support\Facades\Schema::dropIfExists($t);
                echo "Drop (kalau ada): {$t}\n";
            }
            echo "\nSelesai. Cek lagi dengan action=migrate-status, lalu coba action=migrate lagi.\n";
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
