# Deploy ke InfinityFree (free tier)

Panduan ini ditulis untuk akun InfinityFree free tier: tanpa SSH, tanpa
akses `php artisan` di server, document root = `htdocs/`, PHP 8.4,
MySQL hanya bisa diakses dari phpMyAdmin di panel (tidak ada remote
access). File terkait: `.env.production`, `deploy/htdocs-index.php`,
`deploy/core.htaccess`, `deploy/deploy-helper.php`.

## 0. Sebelum mulai

- `.env.production` sudah diisi lengkap (DB, APP_URL, ADMIN_EMAIL/PASSWORD, DEPLOY_SECRET).
- Jangan pernah upload `.env` lokal (SQLite) ke server - yang diupload adalah `.env.production`, di-rename jadi `.env` DI SERVER.

## 1. Build lokal (jalankan di laptop, bukan di server)

```
composer install --no-dev --optimize-autoloader
npm run build
```

Ini menghasilkan `vendor/` tanpa dev-dependency dan `public/build/` (CSS/JS terkompilasi).

## 2. Struktur yang diupload

InfinityFree hanya punya `htdocs/` sebagai web root, dan Laravel butuh
`public/` sebagai web root. Solusinya: pisah dua bagian.

```
htdocs/                          <- web root InfinityFree
├── index.php                    <- dari deploy/htdocs-index.php (BUKAN public/index.php asli)
├── .htaccess                    <- dari deploy/htdocs.htaccess (WAJIB - tanpa ini semua route
│                                    selain '/' kena 404 dari Apache, bukan dari Laravel)
├── favicon.ico                  <- dari public/
├── robots.txt                   <- dari public/
├── images/                      <- dari public/images/
├── build/                       <- dari public/build/ (hasil npm run build)
├── deploy-helper.php            <- SEMENTARA, hapus setelah setup (lihat langkah 5)
└── core/                        <- SEMUA folder Laravel lainnya
    ├── .htaccess                <- dari deploy/core.htaccess (blokir akses langsung)
    ├── .env                     <- dari .env.production, DI-RENAME jadi .env
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── vendor/
    ├── storage/
    ├── artisan
    ├── composer.json
    └── composer.lock
```

Yang **tidak perlu** diupload: `node_modules/`, `.git/`, `tests/`,
`.env` (lokal), `public/` (sudah dipecah di atas), `deploy/` (sudah
dipakai, isinya sudah ditaruh di tempat masing-masing).

## 3. Cara upload (lewat File Manager InfinityFree, bukan FTP satu-satu)

FTP file satu-satu untuk `vendor/` (ribuan file) akan sangat lambat.
Lebih cepat:

1. Di laptop, masuk ke folder `deploy-package/` (bukan root project), **pilih isi di dalamnya**
   (`core/` dan semua file+folder level `htdocs/` - lihat daftar di atas), **BUKAN folder
   `deploy-package` itu sendiri atau folder `htdocs` sebagai pembungkus**. Compress jadi satu zip.
   - Salah: zip berisi `htdocs/` (folder) + `core/` (folder) → hasil extract jadi
     `htdocs/htdocs/...` (nested, index.php tidak ketemu Apache). Ini pernah terjadi dan
     menyebabkan 404/halaman "domain ready" InfinityFree selama berjam-jam sampai ketahuan.
   - Benar: zip berisi `index.php`, `.htaccess`, `favicon.ico`, `robots.txt`, `images/`,
     `build/`, `deploy-helper.php`, DAN `core/` (folder) - semuanya di root zip, sejajar.
2. Upload zip itu lewat File Manager InfinityFree **ke dalam** `htdocs/` (folder yang sudah ada
   dari InfinityFree, isinya default cuma file placeholder "DO NOT UPLOAD..." dkk - boleh dihapus).
3. Gunakan fitur **Extract** di File Manager mereka untuk membongkar zip langsung di situ.
4. Hapus `deploy.zip` dan file placeholder bawaan InfinityFree (`index.html`/`index2.html`,
   "files for your website should be uploaded here!") setelah berhasil diextract.
5. **Cek ulang** hasil extract: `htdocs/index.php` dan `htdocs/core/` harus sejajar langsung
   di dalam `htdocs/` - BUKAN `htdocs/htdocs/index.php`.

## 3.5. WAJIB: verifikasi folder kosong ikut ter-extract

Banyak tool zip/extract (termasuk File Manager InfinityFree) **tidak menyimpan folder yang
benar-benar kosong** di dalam arsip zip. Setelah extract, cek folder-folder berikut benar-benar
ada di `htdocs/core/storage/`:

```
storage/framework/cache/data/
storage/framework/sessions/
storage/framework/testing/
storage/framework/views/
```

Kalau folder `framework/` sama sekali tidak ada (bukan cuma subfoldernya), buat manual lewat
File Manager - ini bukan tanda ada yang salah di langkah lain, cuma folder kosong memang sering
tidak ikut ter-extract. Gejalanya kalau terlewat: situs error 500, log di
`storage/logs/laravel.log` bilang `InvalidArgumentException: Please provide a valid cache path.`

## 4. Setelah file terupload - jalankan deploy-helper.php

Buka tiap URL ini di browser **satu per satu, cek hasilnya dulu sebelum lanjut**,
ganti `TOKEN` dengan isi `DEPLOY_SECRET` di `.env`:

```
https://domainmu/deploy-helper.php?token=TOKEN&action=status
```
→ pastikan "DB: terkoneksi" muncul. Kalau gagal, cek ulang DB_HOST/USERNAME/PASSWORD di `.env` server.

```
https://domainmu/deploy-helper.php?token=TOKEN&action=migrate
```
→ membuat semua tabel di database InfinityFree (termasuk migrasi drop kolom gambar_jalur_url, otomatis urut sesuai nama file migrasi).

```
https://domainmu/deploy-helper.php?token=TOKEN&action=storage-link
```
→ coba buat symlink `htdocs/storage -> core/storage/app/public` (untuk serve gambar upload).
Kalau gagal (banyak shared hosting mematikan fungsi `symlink()` demi keamanan - ini yang
terjadi di InfinityFree), set `FILESYSTEM_SERVE_VIA_ROUTE=true` di `.env` server - sudah ada
fallback route `/media/{path}` (`MediaController`) yang stream file tanpa symlink, lihat
Troubleshooting di bawah.

```
https://domainmu/deploy-helper.php?token=TOKEN&action=seed-admin
```
→ membuat user admin pertama dari `ADMIN_EMAIL`/`ADMIN_PASSWORD` di `.env`.

```
https://domainmu/deploy-helper.php?token=TOKEN&action=optimize
```
→ cache config/route/view biar lebih cepat (opsional tapi disarankan untuk production).

## 5. WAJIB: bersih-bersih setelah selesai

- **Hapus `htdocs/deploy-helper.php` dari server.** Jangan dibiarkan online -
  siapa pun yang tebak URL + token bisa migrate ulang/seed ulang.
- **Hapus `ADMIN_EMAIL` dan `ADMIN_PASSWORD` dari `.env` di server** (buka lewat File Manager,
  edit, hapus dua baris itu) - supaya password admin tidak tersimpan permanen di file.
- **Hapus `DEPLOY_SECRET` dari `.env`** juga, kalau sudah tidak akan pakai deploy-helper.php lagi.

## 6. Verifikasi akhir

- Buka `https://domainmu/` - halaman pencarian publik harus tampil, CSS/JS (hasil `npm run build`) harus kelihatan normal.
- Login admin pakai kredensial yang dipakai saat `seed-admin`.
- Coba buka salah satu jalur yang punya gambar - gambar harus tampil (tes hasil `storage-link`).
- Coba upload gambar baru lewat admin, cek apakah muncul di halaman publik.

## Troubleshooting

**`symlink()` gagal / tidak didukung di server**
Terjadi di InfinityFree. Sudah diimplementasikan: set `FILESYSTEM_SERVE_VIA_ROUTE=true` di
`.env` server. `JalurGambar::getUrlAttribute()` otomatis pakai route `/media/{path}`
(`MediaController::show`, lihat `config/filesystems.php` kunci `serve_public_via_route`)
yang men-stream file langsung dari `storage/app/public/...` tanpa symlink. Biarkan
`false`/kosong di lokal (lebih cepat pakai symlink statis biasa).

**Halaman blank / error 500 setelah upload**
- Cek `core/storage/logs/laravel.log` lewat File Manager (kalau `APP_DEBUG=false`,
  error tidak ditampilkan ke browser, cuma dicatat di log ini) - selalu langkah pertama,
  pesan errornya biasanya langsung menunjukkan masalahnya persis (lihat 2 entri di atas
  untuk 2 error yang sudah pernah terjadi: cache path & Vite manifest).
- Pastikan folder `core/storage/framework/{cache,sessions,views}`, `core/storage/framework/cache/data`,
  dan `core/bootstrap/cache` ada dan bisa ditulis - lihat poin 3.5 di atas soal folder kosong.

**Semua halaman selain `/` kena 404 (termasuk /login, /admin, /media/...)**
- Ini berarti `.htaccess` di `htdocs/` (hasil copy dari `public/.htaccess` asli) tidak ada/tidak
  terupload. Tanpa file ini, Apache tidak tahu cara mengarahkan URL ke `index.php` - dia cari
  folder/file fisik sesuai nama URL-nya, tidak ketemu, dan langsung kasih 404 miliknya sendiri
  (bukan 404 Laravel) sebelum request sempat sampai ke PHP.
- Ciri-cirinya: 404 yang muncul terlihat seperti halaman error generik InfinityFree/Apache,
  bukan halaman 404 Laravel yang biasa (ada style khusus / "419 | Page Not Found" versi Laravel).
- Fix: upload `deploy/htdocs.htaccess` sebagai `.htaccess` di `htdocs/` (root, BUKAN di dalam
  `core/` - itu file `.htaccess` yang berbeda, lihat struktur di atas). Pastikan nama filenya
  benar `.htaccess` (dengan titik di depan), bukan `htaccess.txt` atau semacamnya.

**CSS/JS tidak muncul (halaman polos tanpa styling) atau error 500 "Vite manifest not found at .../core/public/build/manifest.json"**
- Pastikan `public/build/` ikut diupload ke `htdocs/build/` (bukan `htdocs/core/public/build/`).
- Cek `APP_URL` di `.env` server sudah benar (dipakai Vite manifest untuk generate URL asset).
- Kalau error log persis menyebut path `core/public/build/manifest.json` (ada kata "core"
  di tengah), itu bukan soal file hilang - Laravel menganggap `public_path()` = `core/public`
  (default Laravel), padahal struktur kita taruh `build/` di `htdocs/` langsung (lihat
  struktur upload di atas). Sudah diperbaiki di `bootstrap/app.php`: kalau `core/public/`
  tidak ada, `$app->usePublicPath()` diarahkan ke `htdocs/` (2 level di atas `bootstrap/`).
  Development lokal tidak terpengaruh (terdeteksi otomatis dari ada/tidaknya `public/` di
  lokasi standar). Kalau masih muncul, pastikan `bootstrap/app.php` versi terbaru sudah
  ter-upload ke `htdocs/core/bootstrap/app.php`.

**"419 Page Expired" saat login/submit form**
- Cek `SESSION_DOMAIN` di `.env` (biarkan `null` kecuali ada alasan spesifik).
- Pastikan `core/storage/framework/sessions` writable (session driver = `database`,
  jadi sebenarnya tidak terlalu tergantung folder ini, tapi tetap cek kalau error).
