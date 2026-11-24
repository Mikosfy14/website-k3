<?php

// Versi public/index.php yang disesuaikan untuk struktur di InfinityFree:
// file ini ditaruh di htdocs/ (document root), sementara sisa aplikasi
// Laravel (app/, vendor/, bootstrap/, dst.) ditaruh di htdocs/core/.
//
// JANGAN jalankan file ini untuk development lokal - pakai public/index.php
// yang asli untuk itu. Lihat docs/deploy-infinityfree.md untuk cara pakai.

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/core/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/core/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/core/bootstrap/app.php';

$app->handleRequest(Request::capture());
