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

1. Di laptop, zip folder project (hasil susunan di atas) jadi satu file, misalnya `deploy.zip`.
2. Upload `deploy.zip` lewat File Manager InfinityFree ke `htdocs/`.
3. Gunakan fitur **Extract** di File Manager mereka untuk membongkar zip langsung di server.
4. Hapus `deploy.zip` setelah berhasil diextract (jangan dibiarkan - isinya termasuk `.env`).

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
Kalau gagal (banyak shared hosting mematikan fungsi `symlink()` demi keamanan),
baca pesan fallback yang muncul - lihat bagian Troubleshooting di bawah.

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
Banyak shared hosting mematikan fungsi ini. Alternatif tanpa ubah kode:
- Opsi manual: setiap kali ada gambar baru diupload, copy folder
  `core/storage/app/public/jalur-mitigasi/` ke `htdocs/storage/jalur-mitigasi/`
  lewat File Manager. Merepotkan tapi tidak butuh ubah kode.
- Opsi lebih baik (butuh sedikit kerja tambahan, belum diimplementasikan):
  buat route Laravel yang men-stream file dari `storage/app/public/...`
  langsung (tanpa symlink), lalu ganti `JalurGambar::getUrlAttribute()`
  supaya mengarah ke route itu bukan ke `Storage::disk('public')->url()`.
  Tanya dulu sebelum ini diimplementasikan - ini mengubah kode, bukan cuma konfigurasi server.

**Halaman blank / error 500 setelah upload**
- Cek `core/storage/logs/laravel.log` lewat File Manager (kalau `APP_DEBUG=false`,
  error tidak ditampilkan ke browser, cuma dicatat di log ini).
- Pastikan folder `core/storage/framework/{cache,sessions,views}` dan
  `core/bootstrap/cache` ada dan bisa ditulis (writable) - kadang hilang
  saat upload karena isinya cuma file `.gitignore` placeholder di git,
  foldernya sendiri mungkin tidak ikut ter-extract kalau zip-nya dibuat
  dari git working tree yang mengecualikan folder kosong.

**CSS/JS tidak muncul (halaman polos tanpa styling)**
- Pastikan `public/build/` ikut diupload ke `htdocs/build/` (bukan `htdocs/core/public/build/`).
- Cek `APP_URL` di `.env` server sudah benar (dipakai Vite manifest untuk generate URL asset).

**"419 Page Expired" saat login/submit form**
- Cek `SESSION_DOMAIN` di `.env` (biarkan `null` kecuali ada alasan spesifik).
- Pastikan `core/storage/framework/sessions` writable (session driver = `database`,
  jadi sebenarnya tidak terlalu tergantung folder ini, tapi tetap cek kalau error).
