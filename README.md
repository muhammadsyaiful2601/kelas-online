# Website Kelas Online Sederhana

Sistem manajemen kelas online sederhana yang memungkinkan calon peserta melihat katalog kelas dan mendaftar, serta Dashboard Admin untuk mengelola katalog kelas, kategori, dan memverifikasi data pendaftar.

Dibangun dengan **Laravel 13**, **PHP 8.4**, **MySQL/PostgreSQL**, **Tailwind CSS**, dan **Blade**.

---

## 📋 Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Peran Pengguna](#peran-pengguna)
- [Fitur Utama](#fitur-utama)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Tahapan Instalasi](#tahapan-instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Kredensial Akun Admin](#kredensial-akun-admin)
- [Struktur Database](#struktur-database)
- [Library Pihak Ketiga](#library-pihak-ketiga)
- [Cara Menjalankan](#cara-menjalankan)
- [Testing](#testing)
- [Lisensi](#lisensi)

---

## Tentang Proyek

Platform web sederhana untuk lembaga pelatihan teknologi yang memungkinkan:

- **Pengunjung (Guest):** Melihat landing page, mencari/memfilter kelas, melihat detail kelas, dan mengisi formulir pendaftaran.
- **Admin:** Mengakses dashboard aman untuk mengelola kategori, kelas (termasuk upload gambar dan status DRAFT/PUBLISHED), serta memverifikasi status pendaftar (PENDING, APPROVED, REJECTED).

---

## Peran Pengguna

| Peran | Akses | Deskripsi |
|-------|-------|-----------|
| **Pengunjung** | Publik (tanpa login) | Melihat katalog kelas published, mencari & memfilter kelas, detail kelas, pendaftaran kelas. |
| **Admin** | Terbatas (butuh login) | Dashboard ringkasan, CRUD kategori & kelas, upload gambar, set status kelas, verifikasi pendaftar. |

---

## Fitur Utama

- Landing page responsif dengan hero section, katalog kelas, dan kontak.
- Katalog kelas yang statusnya `PUBLISHED` dengan pencarian (judul/deskripsi) dan filter kategori.
- Pagination pada daftar kelas.
- Halaman detail kelas dengan deskripsi, instruktur, harga, dan formulir pendaftaran (Nama, Email, No. HP).
- Pencegahan registrasi ganda (satu email tidak dapat mendaftar dua kali pada kelas yang sama) melalui unique composite constraint.
- Autentikasi admin (login/logout) dengan Laravel Breeze / session.
- Dashboard admin: total kelas, total pendaftar, dan 5 pendaftar terbaru.
- CRUD kategori kelas.
- CRUD kelas dengan upload gambar dan penetapan status (`DRAFT` / `PUBLISHED`).
- Kelola pendaftar: daftar per kelas dan dropdown update status (`PENDING`, `APPROVED`, `REJECTED`).
- Export data pendaftar ke CSV (fitur bonus).
- Automated test untuk pencegahan registrasi ganda.

---

## Persyaratan Sistem

| Komponen | Versi |
|----------|-------|
| PHP | 8.3 atau 8.4+ |
| Laravel | 13.x |
| Database | MySQL atau PostgreSQL |
| Composer | 2.x |
| Node.js / npm | Untuk compile asset (Tailwind) |
| Web Server | Apache / Nginx (atau `php artisan serve`) |

---

## Tahapan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek secara lokal:

### 1. Clone Repositori

```bash
git clone https://github.com/muhammadsyaiful2601/kelas-online.git
cd kelas-online
```

### 2. Install Dependensi PHP (Composer)

```bash
composer install
```

---

## Konfigurasi Database

File `.env` yang relevan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=password_anda
```

---

## Kredensial Akun Admin

Setelah menjalankan `php artisan migrate --seed`, akun admin default tersedia:

| Field | Nilai |
|-------|-------|
| Email | `admin@gmail.com` |
| Password | `password` |

Gunakan kredensial ini untuk login ke halaman admin (`/login`).

---

## Struktur Database

Tabel utama yang dibuat oleh migrasi:

### `categories`
- `id` (PK)
- `name`, `slug` (unique), `description`
- `timestamps`

### `courses`
- `id` (PK)
- `category_id` (FK → categories)
- `title`, `slug` (unique), `description`, `instructor`
- `price` (decimal), `is_free` (boolean)
- `image` (nullable)
- `status` (`DRAFT` / `PUBLISHED`)
- `soft_deletes`, `timestamps`

---

## Library Pihak Ketiga

Berikut daftar library/package yang digunakan dalam proyek ini:

| Package | Fungsi |
|---------|--------|
| `laravel/framework` | Framework PHP inti (Laravel 13) |
| `laravel/breeze` | Starter kit autentikasi (Blade) |
| `tailwindcss` | CSS utility-first framework |
| `vite` | Build tool untuk asset frontend |
| `phpunit/phpunit` | Framework testing |
| `nesbot/carbon` | Manipulasi tanggal dan waktu |
| `guzzlehttp/guzzle` | HTTP client |

Semua terdaftar dalam `composer.json` dan `package.json`.

---

## Cara Menjalankan

```bash
# Menjalankan server development
php artisan serve

# Compile asset untuk production
npm run build

# Jalankan semua automated test
php artisan test
```

---

## Testing

Proyek menyertakan automated test untuk memastikan pencegahan registrasi ganda berfungsi dengan benar. Jalankan semua test dengan:

```bash
php artisan test
```

---

## Lisensi

Proyek ini bersifat terbuka dan dikembangkan sebagai bagian dari proses wawancara teknis.

---

## Catatan

- File `.env` **tidak di-upload ke GitHub** (sudah di-ecualikan melalui `.gitignore`) untuk alasan keamanan.
- Pastikan `php artisan storage:link` dijalankan agar gambar kelas dapat diakses secara publik.
- Database default yang digunakan adalah MySQL; untuk PostgreSQL, sesuaikan `DB_CONNECTION=pgsql` di `.env`.

### `enrollments`
- `id` (PK)
- `course_id` (FK → courses)
- `name`, `email`, `phone` (nullable)
- `status` (`PENDING` / `APPROVED` / `REJECTED`)
- **Unique composite:** `['course_id', 'email']` — mencegah pendaftaran ganda dengan email yang sama pada kelas yang sama.
- `timestamps`

### Relasi Eloquent
- `Category` `hasMany` `Course`
- `Course` `belongsTo` `Category` & `hasMany` `Enrollment`
- `Enrollment` `belongsTo` `Course`

### Enums (PHP Native)
- `CourseStatus`: `DRAFT`, `PUBLISHED`
- `EnrollmentStatus`: `PENDING`, `APPROVED`, `REJECTED`

### 3. Salin File Konfigurasi Environment

Salin `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

> **Penting:** File `.env` **tidak** di-commit ke Git (sudah ada di `.gitignore`) karena berisi kredensial sensitif. Buat file `.env` sendiri di komputer lokal.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kelas_online
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `kelas_online` sudah dibuat di MySQL/PostgreSQL sebelum menjalankan migrasi.

### 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```

Perintah ini akan membuat semua tabel dan menambahkan data dummy: kategori, kelas, dan akun admin default.