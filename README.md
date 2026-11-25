# Sistem Informasi Jalur Evakuasi K3

Aplikasi web untuk menemukan dan mengelola jalur evakuasi/mitigasi K3 (Keselamatan dan
Kesehatan Kerja) pada gedung bertingkat. Dibangun untuk gedung kampus Fakultas Vokasi
Universitas Brawijaya, Kampus 2 Dieng.

**Live demo:** https://vokasievac-k3.infinityfree.io/

## Fitur

### Publik (tanpa login)
- Cari jalur evakuasi berdasarkan lantai, atau berdasarkan ruangan (otomatis mengarah ke
  lantai tempat ruangan itu berada).
- Lihat detail jalur: deskripsi instruksi evakuasi, titik kumpul (assembly point), dan
  galeri foto/peta jalur.

### Admin (perlu login)
- Dashboard ringkasan jumlah gedung, lantai, ruangan, dan jalur mitigasi.
- CRUD penuh untuk:
  - **Gedung** — nama, alamat, deskripsi singkat.
  - **Lantai** — terhubung ke satu gedung dan satu jalur mitigasi.
  - **Ruangan** — nama dan kode ruangan, terhubung ke satu lantai.
  - **Jalur Mitigasi** — nama jalur, instruksi evakuasi, titik kumpul, dan upload banyak
    foto/peta sekaligus (tambah, hapus per gambar lewat AJAX).
- Pencarian dan filter pada setiap halaman index admin.

## Tech stack

| Layer | Teknologi |
|---|---|
| Backend | PHP 8.2+ / Laravel 12 |
| Frontend | Blade, Tailwind CSS 4 + Vite 7, Bootstrap 5 |
| Database | MySQL (production) / SQLite (lokal) |
| Auth | Laravel session-based auth, rate limiting pada login |
| Testing | Pest |

## Struktur data

```
Gedung 1──* Lantai *──1 JalurMitigasi 1──* JalurGambar
                │
                1
                │
                *
             Ruangan
```

- Satu **gedung** punya banyak **lantai**.
- Setiap **lantai** terhubung ke satu **jalur mitigasi** (satu jalur bisa dipakai beberapa
  lantai yang berbeda — misal jalur evakuasi yang sama untuk lantai 2–7).
- Setiap **lantai** punya banyak **ruangan**.
- Setiap **jalur mitigasi** bisa punya banyak **gambar** (foto/peta), disimpan satu baris
  per gambar di tabel `jalur_gambar`.

## Instalasi lokal

```bash
git clone <repo-url>
cd website-k3

composer install
npm install

cp .env.example .env
php artisan key:generate

# Isi ADMIN_EMAIL dan ADMIN_PASSWORD di .env sebelum seeding,
# supaya ada akun admin pertama yang bisa dipakai login.

php artisan migrate --seed
php artisan storage:link

npm run build
php artisan serve
```

Untuk development dengan hot-reload aset:

```bash
composer dev
```

(menjalankan `php artisan serve`, queue listener, dan `npm run dev` secara bersamaan)

## Keamanan

- Password di-hash dengan bcrypt, tidak ada kredensial admin yang hardcode di kode sumber —
  dibuat lewat seeder yang membaca dari environment variable.
- Login dibatasi 5 percobaan gagal per 60 detik, dikunci berdasarkan kombinasi email + IP.
- Upload gambar dibatasi tipe file (JPEG/PNG/JPG/GIF) dan ukuran maksimum per file, SVG
  sengaja tidak diizinkan untuk mencegah stored XSS.
- Middleware khusus mencegah halaman admin diakses lagi lewat tombol back browser setelah
  logout.

## Routing utama

| Method | URL | Keterangan |
|---|---|---|
| GET | `/` | Halaman pencarian publik |
| POST | `/cari` | Proses pencarian jalur evakuasi |
| GET/POST | `/login` | Form & proses login admin |
| POST | `/logout` | Logout |
| GET | `/admin/dashboard` | Dashboard admin |
| resource | `/admin/gedung`, `/admin/lantai`, `/admin/ruangan`, `/admin/jalur-mitigasi` | CRUD masing-masing modul |

## Lisensi

Project ini dibuat untuk keperluan internal kampus dan portofolio pribadi.
