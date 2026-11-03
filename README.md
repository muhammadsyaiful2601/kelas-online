# Website Kelas Online Sederhana

Sistem manajemen kelas online berbasis web yang memungkinkan pengunjung melihat katalog kelas dan mendaftar, serta admin untuk mengelola katalog kelas, kategori, dan verifikasi pendaftar.

**Nama Proyek:** Website Kelas Online Sederhana  
**Kandidat:** Muhammad Syaiful  
**Email:** muhammadsyaiful2601@gmail.com  
**Teknologi Utama:** Laravel 13, PHP 8.4, MySQL / PostgreSQL / SQLite, Tailwind CSS, Blade  
**Tanggal:** 3 November 2026  
**Repositori:** https://github.com/muhammadsyaiful2601/kelas-online.git

---

## Tentang Sistem

Website Kelas Online Sederhana adalah platform pelatihan teknologi yang terdiri dari dua bagian utama:

1. **Landing Page (Public)** — Akses tanpa login. Pengunjung dapat melihat daftar kelas yang sudah dipublikasikan, mencari dan memfilter kelas berdasarkan kategori, melihat detail kelas, dan mengisi formulir pendaftaran.
2. **Dashboard Admin (Terautentikasi)** — Akses terbatas (harus login). Admin dapat melihat statistik ringkasan, mengelola kategori dan kelas (CRUD dengan upload gambar dan status DRAFT/PUBLISHED), serta memverifikasi status pendaftar (PENDING / APPROVED / REJECTED).

Sistem ini mencegah registrasi ganda: satu alamat email tidak dapat mendaftar dua kali pada kelas yang sama.

---

## Fitur Utama

### Pengunjung (Guest / Publik)
- Melihat halaman utama (Hero Section, informasi platform, kontak)
- Melihat katalog kelas dengan status `PUBLISHED`
- Mencari kelas berdasarkan judul/deskripsi
- Memfilter kelas berdasarkan kategori
- Pagination pada daftar kelas
- Melihat detail kelas (deskripsi, instrutor, harga, gambar)
- Mendaftar kelas melalui formulir (Nama, Email, No. HP)
- Pencegahan registrasi ganda (email unik per kelas)

### Admin (Auth)
- Login dan logout aman (Laravel Breeze / Auth session)
- Statistik ringkasan (total kelas, total pendaftar, 5 pendaftar terbaru)
- Kelola Kategori (CRUD)
- Kelola Kelas (CRUD + upload gambar + status DRAFT/PUBLISHED)
- Kelola Pendaftar (lihat daftar per kelas, ubah status PENDING/APPROVED/REJECTED)
- Export data pendaftar ke CSV (fitur bonus)

---

## Teknologi yang Digunakan

| Komponen | Versi / Nama |
|----------|--------------|
| PHP | 8.4 (cocok 8.3 / 8.5) |
| Framework | Laravel 13 |
| Database | MySQL / PostgreSQL / SQLite (default proyek ini SQLite) |
| Frontend | Tailwind CSS, Blade, Vite |
| Autentikasi | Laravel Breeze (Blade) |
| Testing | Pest / PHPUnit |
| Package Manager | Composer, NPM |

---

## Persyaratan Sistem

Sebelum instalasi, pastikan sudah terinstall:

- **PHP 8.3+** (disarankan 8.4)
- **Composer 2.x**
- **Node.js & NPM** (untuk compile asset Tailwind/Vite)
- **Database server** (MySQL, PostgreSQL, atau gunakan SQLite bawaan)
- **Git**

---

## Struktur Database

Proyek ini menggunakan 4 tabel utama beserta relasi Eloquent:

| Tabel | Deskripsi |
|-------|-----------|
| `categories` | Kategori kelas (Pemrograman, Desain, Bisnis, Bahasa, dst.) |
| `courses` | Data kelas (terkait kategori, status DRAFT/PUBLISHED, harga, gambar) |
| `enrollments` | Data pendaftar (terkait kelas, nama, email, no HP, status) |
| `users` | Akun admin (auth) |

### Relasi Eloquent
- `Category` **hasMany** `Course`
- `Course` **belongsTo** `Category` & **hasMany** `Enrollment`
- `Enrollment` **belongsTo** `Course`

### Enum
- `CourseStatus`: `DRAFT`, `PUBLISHED`
- `EnrollmentStatus`: `PENDING`, `APPROVED`, `REJECTED`

### Constraint Khusus
- Tabel `enrollments` memiliki **unique composite constraint** pada `['course_id', 'email']` untuk mencegah registrasi ganda.


## Panduan Instalasi

### 1. Clone Repositori

```bash
git clone https://github.com/muhammadsyaiful2601/kelas-online.git
cd kelas-online
```

### 2. Install Dependensi PHP (Composer)

```bash
composer install
```

### 3. Install Dependensi Frontend (NPM)

```bash
npm install
npm run build
```

### 4. Salin dan Konfigurasi File `.env`

Salin file contoh menjadi `.env`:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Edit file `.env` dan sesuaikan koneksi database. Contoh menggunakan **SQLite** (default, siap pakai tanpa server database eksternal):

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Atau jika ingin menggunakan **MySQL**, ubah menjadi:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

> **Penting:** Pastikan database `laravel` sudah dibuat di MySQL/PostgreSQL sebelum menjalankan migrasi.

### 5. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```

Perintah ini akan membuat semua tabel dan memasukkan data dummy (kategori, kelas, dan akun admin).

### 6. Link Storage (untuk akses gambar kelas publik)

```bash
php artisan storage:link
```

### 7. Jalankan Server Pengembangan

```bash
php artisan serve
```

Buka browser dan kunjungi: `http://127.0.0.1:8000`

---

## Kredensial Akun Admin

Setelah menjalankan `php artisan migrate --seed`, akun admin default tersedia:

| Field | Nilai |
|-------|-------|
| Email | `admin@gmail.com` |
| Password | `password` |

Gunakan kredensial ini untuk login ke halaman admin (`/login` atau `/admin`).

---

## Library / Pihak Ketiga yang Digunakan

### Composer (PHP)
- `laravel/framework` v13 — Framework web PHP
- `laravel/tinker` — Console REPL untuk Laravel
- `laravel/breeze` — Starter kit autentikasi (Blade)
- `nesbot/carbon` — Manipulasi tanggal dan waktu
- `ramsey/uuid` — Generate UUID
- `guzzlehttp/guzzle` — HTTP client
- `mockery/mockery` & `phpunit/phpunit` — Testing
- `laravel/pint` — Code style formatter

### NPM (Frontend)
- `tailwindcss` — CSS framework utility-first
- `vite` — Build tool / dev server
- `laravel-vite-plugin` — Integrasi Vite dengan Laravel

---

## Catatan Penting

- File `.env` **tidak di-commit ke GitHub** (sudah tercantum di `.gitignore`) karena berisi informasi sensitif seperti `APP_KEY` dan kredensial database. Setiap developer harus menyalin `.env.example` dan mengkonfigurasi sendiri.
- Jika menggunakan SQLite, file database akan otomatis dibuat di `database/database.sqlite`. Tidak perlu install server database terpisah.
- Untuk upload gambar kelas, pastikan `php artisan storage:link` sudah dijalankan agar gambar dapat diakses melalui `public/storage`.

---

## Lisensi

Proyek ini bersifat terbuka untuk pembelajaran dan portofolio.
---
