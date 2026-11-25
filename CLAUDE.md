# CLAUDE.md — website-k3

## Ringkasan project
Aplikasi web **jalur evakuasi / mitigasi K3** untuk gedung kampus Fakultas Vokasi Universitas
Brawijaya Kampus 2 Dieng (dikonfirmasi lewat data real di DB, bukan dugaan lagi).
- Publik (tanpa login): pilih lantai (+ruangan opsional) → lihat jalur evakuasi, deskripsi, assembly point, gambar.
- Admin (login, role `admin`): CRUD Gedung, Lantai, Ruangan, Jalur Mitigasi (+ upload banyak gambar), dashboard.
- Alur data: Gedung 1─* Lantai *─1 JalurMitigasi; Lantai 1─* Ruangan; JalurMitigasi 1─* JalurGambar.
  Pencarian publik: `POST /cari` → Ruangan/Lantai → `lantai->jalurMitigasi`.
- UI & pesan berbahasa Indonesia; komentar kode campur ID/EN.
- **Live di production**: https://vokasievac-k3.infinityfree.io/ (InfinityFree free tier).

## Tech stack
| Item | Versi / catatan |
|---|---|
| PHP | `^8.2` di composer.json; production jalan di PHP 8.4 (InfinityFree, resmi didukung Laravel 12) |
| Laravel | `^12.0` |
| Test | Pest `^4.1` (+ plugin-laravel) — hanya contoh bawaan. `php artisan test` butuh PHP ≥8.3 lokal (bug dependency `sebastian/environment` di PHP 8.2) |
| Lint | Laravel Pint `^1.24` |
| Frontend | Blade + Tailwind `^4` + Vite `^7`, Bootstrap 5.3.3 (CDN, dipakai paralel ke Tailwind) |
| DB lokal | SQLite (`.env.example`) | DB production | MySQL (InfinityFree, lewat phpMyAdmin saja - tidak ada remote access) |
| Dev tools | laravel/boost, pail, sail, tinker; folder `.cursor/` & `boost.json` |

## Struktur folder
| Path | Isi |
|---|---|
| `app/Http/Controllers/EvakuasiController.php` | halaman publik (`index`, `cari`) |
| `app/Http/Controllers/MediaController.php` | fallback serve gambar tanpa symlink (lihat Deploy) |
| `app/Http/Controllers/Admin/*` | Dashboard, Gedung, Lantai, Ruangan, JalurMitigasi |
| `app/Http/Controllers/Auth/LoginController.php` | login/logout, rate limit 5x/60s per email+IP |
| `app/Http/Middleware` | `CheckAdmin` (`admin`), `PreventBackHistory` (`prevent.back`), `RedirectIfAuthenticated` |
| `app/Models` | Gedung, Lantai, Ruangan, JalurMitigasi, JalurGambar, User (PK custom `id_*`) |
| `database/migrations`, `seeders` | 4 tabel domain + `jalur_gambar` + `users.role`; seeder per tabel |
| `resources/views` | `evakuasi/` (publik), `admin/<modul>/`, `auth/`, `layouts/app`, `components/layouts/public`, `vendor/pagination` |
| `routes/web.php` | semua route (tidak ada `api.php`); termasuk `/media/{path}` fallback |
| `storage/app/public/jalur-mitigasi` | upload gambar (di-link ke `public/storage` lokal) |
| `deploy/` | artifact deploy InfinityFree: `htdocs-index.php`, `htdocs.htaccess`, `core.htaccess`, `deploy-helper.php` (template, bukan yang live) |
| `docs/deploy-infinityfree.md` | runbook deploy lengkap, termasuk semua gotcha yang pernah ketemu |
| `tests/` | hanya ExampleTest (Feature & Unit) |

## Perintah
- Install: `composer install`, `npm install`, salin `.env.example` → `.env`, `php artisan key:generate`, `php artisan migrate --seed`, `php artisan storage:link` (BELUM DIVERIFIKASI ulang dari fresh clone)
- Run: `composer dev` (serve + queue:listen + vite), atau `php artisan serve` + `npm run dev`; build: `npm run build`
- Test: `php artisan test` (perlu PHP ≥8.3, lihat Tech stack)
- Lint: `vendor/bin/pint`
- Lingkungan lokal: Laragon di Windows (PHP 8.2.33 & 8.3.16 terpasang, MySQL 8.4.3 lokal juga ada tapi tidak dipakai project ini).

## Konvensi kode
- Tabel singular Indonesia (`gedung`, `lantai`, `ruangan`, `jalur_mitigasi`, `jalur_gambar`); PK `id_<tabel>`; FK `id_gedung`, `id_jalur`, `id_lantai`. Model set `$table`, `$primaryKey`, `$fillable`, relasi dengan kunci eksplisit.
- Controller admin: resource controller, validasi inline `$request->validate()` (tanpa FormRequest), `findOrFail($id)` (bukan route-model-binding), flash `success`/`error`, redirect ke `admin.<modul>.index`.
- Index admin: search + filter via query string, `paginate(5)->withQueryString()`.
- **Gambar**: disk `public`, folder `jalur-mitigasi`, **satu baris per gambar di tabel `jalur_gambar`** (bukan JSON lagi). Akses URL SELALU lewat `JalurGambar::getUrlAttribute()` / `JalurMitigasi::gambar_urls` & `gambar_full_urls` — jangan pernah bentuk URL manual (`asset('storage/'...)`) di controller/view baru, supaya abstraksi storage (termasuk fallback non-symlink) tetap konsisten.
- Route admin: grup `['auth','admin','prevent.back']`, prefix `admin`, nama `admin.*`.
- Pesan UI & validasi dalam Bahasa Indonesia. Kode baru ikuti gaya ini.

## Area berisiko / jangan disentuh sembarangan
- **Skema DB & PK custom**: mengubah kolom `id_*` memecah relasi, view, dan JS dropdown di `evakuasi/index`.
- **`bootstrap/app.php`**: ada logic `usePublicPath()` kondisional untuk struktur deploy InfinityFree (htdocs/+core/ split) - JANGAN dihapus, dan jangan diubah tanpa paham bagian "Deploy" di bawah. Terdeteksi otomatis lewat ada/tidaknya `public/`, jadi aman untuk lokal, tapi tetap hati-hati.
- **Auth/middleware** (`CheckAdmin`, `PreventBackHistory`, `LoginController`) dan `.env`/`.env.production` (jangan dibuka/dicetak isinya).
- `public/storage`, `storage/app/public`: upload nyata (di-ignore git) — jangan hapus/reset.
- `database/database.sqlite` ada lokal (ter-ignore); jangan `migrate:fresh` tanpa izin.
- `deploy-package/` (gitignored, lokal) dan `deploy/data-export.sql` (gitignored) berisi kredensial/data real kalau pernah dibuat ulang - jangan commit.
- **Jangan pernah menuliskan password atau secret asli (admin, DB, token) ke file apa pun yang ter-commit**, termasuk file dokumentasi ini.

## Deploy (InfinityFree, production)
- Target sudah diputuskan dan **live**: https://vokasievac-k3.infinityfree.io/
- Struktur server beda dari lokal: `htdocs/` (web root) + `htdocs/core/` (semua kode Laravel,
  termasuk `vendor/`). `public/` TIDAK dipindah apa adanya — isinya dipecah (lihat
  `docs/deploy-infinityfree.md` lengkap).
- Tidak ada SSH/artisan di server. Command Laravel (migrate, seed, storage-link, optimize)
  dipicu lewat `deploy-helper.php` (HTTP endpoint ber-token, **sementara**, dihapus setelah
  dipakai) — lihat `deploy/deploy-helper.php` sebagai template kalau perlu deploy ulang.
- `symlink()` dimatikan di InfinityFree. Gambar diserve lewat route `/media/{path}` ->
  `MediaController`, diaktifkan dengan `FILESYSTEM_SERVE_VIA_ROUTE=true` di `.env` server saja.
- Runbook lengkap + semua gotcha yang pernah ketemu (zip/extract nested folder, folder kosong
  tidak ikut ter-extract, Vite manifest path, dst.): baca `docs/deploy-infinityfree.md`
  sebelum deploy ulang atau redeploy project lain dengan pola serupa.

## Utang teknis & peluang (urut prioritas, status per sesi ke-2)
1. ~~Kredensial admin hardcoded~~ selesai — `UserSeeders` baca dari `.env` (`ADMIN_EMAIL`/`ADMIN_PASSWORD`).
2. ~~Login tanpa rate limiting~~ selesai — 5 percobaan/60 detik per email+IP.
3. ~~`gambar_jalur_url` JSON-in-varchar~~ selesai — pindah ke tabel `jalur_gambar`, kolom lama di-drop.
4. **Test nyaris nol** untuk fitur kritis (pencarian, auth, upload) — belum dikerjakan.
5. ~~`evakuasi/view.blade.php` kode mati~~ dihapus, begitu juga `welcome.blade.php`.
6. ~~`EvakuasiController::index` N+1 query~~ selesai — eager load. `cari` masih mencocokkan ruangan hanya dari `nama_ruangan` (bisa ambigu antar-lantai) — belum diperbaiki.
7. ~~`Log::info` debug di `JalurMitigasiController::update`~~ dihapus.
8. `README.md` masih bawaan Laravel; tidak ada CI. Ada docs deploy sekarang (`docs/deploy-infinityfree.md`), tapi belum ada CI/testing otomatis.
9. Satu jalur dipakai banyak lantai (relasi `hasMany`) — desain, bukan bug.
10. **Baru**: dua framework CSS jalan paralel (Tailwind + Bootstrap CDN) — belum dirapikan, berisiko bikin bundle lebih berat dari perlu.
11. **Baru**: password admin production diset manual oleh pemilik (bukan hasil generate acak) — pertimbangkan ganti ke password lebih kuat lewat phpMyAdmin/fitur ganti-password kalau ada waktu.

## Rencana & keputusan pemilik (histori)
- Tujuan: portofolio.
- Urutan dikerjakan: (1) keamanan → (2) optimasi → (3) rapikan struktur → (4) deploy. Semua selesai.
- Hosting sempat dipertimbangkan Vercel, lalu **InfinityFree** (satu akun, bukan 3 akun terpisah
  per project — keputusan terakhir pemilik, menerima risiko kuota 5GB dibagi rame-rame kalau
  deploy project lain di akun yang sama nanti).
- Fitur view 360: dibuang (data tidak bisa dikumpulkan lagi, pemilik sudah tidak di Malang).
- Semua perubahan tetap butuh persetujuan pemilik dulu sebelum eksekusi — pola kerja yang dipakai sepanjang sesi 1 & 2.

## Hal yang belum jelas
- Peran `components/layouts/public` vs `layouts/app` (dua sistem layout berdampingan) — belum dirapikan.
- Apakah akan deploy project lain pemilik ke akun InfinityFree yang sama (mempengaruhi kuota 5GB bersama).
- Branch kerja sesi 1-2 (`security/fase-1`, berisi >12 commit Fase 1-3 + seluruh persiapan/perbaikan deploy) belum di-push/PR ke `main` per akhir sesi ke-2.
