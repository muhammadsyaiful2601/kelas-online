# PRODUCT REQUIREMENT DOCUMENT (PRD)
## ANALISIS DAN PERANCANGAN SISTEM WEBSITE KELAS ONLINE SEDERHANA

**Nama Proyek:** Website Kelas Online Sederhana  
**Kandidat:** Muhammad Syaiful  
**Email:** muhammadsyaiful2601@gmail.com  
**Teknologi Utama:** Laravel 13, PHP 8.5 / 8.3, MySQL / PostgreSQL, Tailwind CSS / Blade  
**Tanggal:** 3 November 2026  

---

## 1. DOKUMEN RINGKASAN & TUJUAN PROYEK

### 1.1 Latar Belakang
Lembaga pelatihan teknologi membutuhkan platform web sederhana yang memungkinkan calon peserta (pengunjung) melihat katalog kelas online dan mendaftar secara langsung. Di sisi internal, pengelola lembaga (admin) membutuhkan Dashboard Admin untuk mengelola katalog kelas, kategori, serta memverifikasi data pendaftar.

### 1.2 Tujuan Sistem
1. Menyediakan Landing Page publik yang responsif, informatif, serta memiliki fitur pencarian dan penyaringan (*filter*) kelas berdasarkan kategori.
2. Memfasilitasi pendaftaran kelas online dengan validasi ketat agar satu alamat email tidak dapat mendaftar dua kali pada kelas yang sama.
3. Menyediakan Dashboard Admin aman berbasis autentikasi untuk memantau ringkasan data, mengelola CRUD kelas & kategori, serta memperbarui status pendaftar (`PENDING`, `APPROVED`, `REJECTED`).

---

## 2. PERAN PENGGUNA (USER ROLES)

| Peran | Akses Khusus | Deskripsi Utama |
| :--- | :--- | :--- |
| **Pengunjung (Guest)** | Publik (Tanpa Login) | Melihat landing page, mencari/memfilter kelas, melihat detail kelas, dan mengisi formulir pendaftaran kelas. |
| **Admin** | Restricted (Memerlukan Auth) | Mengakses dashboard ringkasan, mengelola data kategori (CRUD), mengelola data kelas (CRUD + Upload Gambar + Status Draft/Published), serta memverifikasi status pendaftar. |

---

## 3. SPESIFIKASI KEBUTUHAN FUNGSIONAL (FUNCTIONAL REQUIREMENTS)

### 3.1 Landing Page (Public)
* `FR-PUB-01`: **Hero Section & Informasi** — Menampilkan banner utama, pengenalan platform, serta informasi kontak.
* `FR-PUB-02`: **Katalog Kelas Published** — Menampilkan daftar kelas yang memiliki status `PUBLISHED`.
* `FR-PUB-03`: **Filter & Pencarian** — Pengunjung dapat mencari kelas berdasarkan kata kunci judul/deskripsi dan memfilter berdasarkan kategori.
* `FR-PUB-04`: **Pagination** — Daftar kelas menggunakan pembagian halaman (*pagination*).
* `FR-PUB-05`: **Detail Kelas & Form Pendaftaran** — Halaman detail kelas memuat deskripsi, instruktur, harga (gratis/berbayar), serta formulir pendaftaran (Nama, Email, No. HP).
* `FR-PUB-06`: **Pencegahan Registrasi Ganda** — Sistem menolak pendaftaran jika email yang sama didaftarkan ulang pada kelas yang sama.

### 3.2 Autentikasi & Admin Dashboard
* `FR-ADM-01`: **Auth Admin** — Fitur login dan logout aman menggunakan Laravel Breeze / Auth session.
* `FR-ADM-02`: **Statistik Ringkasan** — Menampilkan total kelas, total pendaftar, dan tabel 5 pendaftar terbaru di halaman utama dashboard.
* `FR-ADM-03`: **Kelola Kategori (CRUD)** — Fitur tambah, lihat, ubah, dan hapus kategori kelas.
* `FR-ADM-04`: **Kelola Kelas (CRUD)** — Fitur tambah, ubah, lihat, dan hapus kelas yang dilengkapi upload gambar (Laravel Storage) dan penetapan status (`DRAFT` / `PUBLISHED`).
* `FR-ADM-05`: **Kelola Pendaftar** — Menampilkan daftar pendaftar per kelas dan dropdown untuk memperbarui status pendaftaran (`PENDING`, `APPROVED`, `REJECTED`).
* `FR-ADM-06`: **Export Data (Bonus)** — Tombol untuk mengekspor data pendaftar ke format CSV.

---

## 4. PERANCANGAN SISTEM (DIAGRAM & DATABASE)

### 4.1 Use Case Diagram

```text
========================================================================
                   SISTEM WEBSITE KELAS ONLINE
========================================================================

  [ Pengunjung (Guest) ]
        |
        +---> (1. Melihat Katalog & Detail Kelas)
        +---> (2. Mencari & Memfilter Kelas Berdasarkan Kategori)
        +---> (3. Mengisi Formulir Pendaftaran Kelas)

  [ Admin ]
        |
        +---> (1. Login / Logout Admin) <<include>>
        +---> (2. Melihat Ringkasan Dashboard & Statistik)
        +---> (3. Mengelola Data Kategori - CRUD)
        +---> (4. Mengelola Data Kelas & Upload Gambar - CRUD)
        +---> (5. Memeriksa & Mengubah Status Pendaftar)
        +---> (6. Ekspor Data Pendaftar ke CSV) [Fitur Bonus]
```

### 4.2 Entity Relationship Diagram (ERD)

```text
+-------------------+       +-------------------------------+       +-------------------------------+
|    categories     |       |            courses            |       |          enrollments          |
+-------------------+       +-------------------------------+       +-------------------------------+
| PK id             |1     N| PK id                         |1     N| PK id                         |
|    name           |<------| FK category_id                |<------| FK course_id                  |
|    slug           |       |    title                      |       |    name                       |
|    created_at     |       |    slug                       |       |    email                      |
|    updated_at     |       |    description                |       |    phone                      |
+-------------------+       |    instructor                 |       |    status (Enum)              |
                            |    price                      |       |    created_at                 |
                            |    image                      |       |    updated_at                 |
                            |    status (Enum)              |       +-------------------------------+
                            |    created_at                 |       | UNIQUE: (course_id, email)    |
                            |    updated_at                 |       +-------------------------------+
                            +-------------------------------+
```

---

## 5. TAHAPAN EKSEKUSI PENGERJAAN (ROADMAP STEP-BY-STEP)

```text
[Tahap 1: Setup & Perancangan] ──► [Tahap 2: Backend Core & DB] ──► [Tahap 3: Admin Dashboard] 
                                                                             │
[Tahap 6: Recording & Submit]  ◄── [Tahap 5: Testing & Doc]  ◄── [Tahap 4: Landing Page & Bonus]
```

### Tahap 1: Inisialisasi & Setup Project
1. Install project Laravel 13 baru menggunakan Composer:
   `composer create-project laravel/laravel online-class-test`
2. Pasang sistem autentikasi admin (misal: Laravel Breeze):
   `composer require laravel/breeze --dev && php artisan breeze:install blade`
3. Konfigurasi file `.env` untuk koneksi database MySQL/PostgreSQL.

### Tahap 2: Struktur Database, Enum & Relasi Eloquent
1. Buat PHP Native Enum pada folder `app/Enums/`:
   - `CourseStatus.php` (`DRAFT`, `PUBLISHED`)
   - `EnrollmentStatus.php` (`PENDING`, `APPROVED`, `REJECTED`)
2. Buat migration untuk tabel `categories`, `courses`, dan `enrollments`:
   - Tambahkan composite constraint unique `['course_id', 'email']` pada tabel `enrollments`.
3. Buat Model Eloquent beserta relasinya:
   - `Category` `hasMany` `Course`
   - `Course` `belongsTo` `Category` & `hasMany` `Enrollment`
   - `Enrollment` `belongsTo` `Course`
4. Buat Seeder (`DatabaseSeeder.php`) untuk memasukkan akun admin default (`admin@gmail.com` / `password`), kategori dummy, dan kelas dummy.
5. Jalankan perintah `php artisan migrate --seed`.

### Tahap 3: Pengembangan Dashboard Admin
1. Buat Controller & Form Request Validation:
   - `CategoryController` (CRUD Kategori)
   - `CourseController` (CRUD Kelas + Upload Gambar menggunakan `Storage::disk('public')`)
   - `EnrollmentController` (Melihat daftar pendaftar & memperbarui status pendaftar)
   - `DashboardController` (Ringkasan total kelas, total pendaftar, dan 5 pendaftar terbaru)
2. Buat antarmuka (view Blade) untuk Admin Dashboard menggunakan layout konsisten.
3. Jalankan `php artisan storage:link` agar gambar kelas dapat diakses publik.

### Tahap 4: Pengembangan Landing Page & Fitur Bonus
1. Buat `LandingController` untuk menangani katalog kelas dengan query scope `published()`.
2. Implementasikan fitur pencarian (`title` / `description`) dan penyaringan berbasis `category_id` dilengkapi *pagination*.
3. Buat halaman detail kelas beserta modal/form pendaftaran.
4. Implementasikan Form Request validation untuk pendaftaran kelas.
5. **Fitur Bonus:**
   - Tambahkan tombol **Export CSV** pendaftar di panel admin.
   - Buat 1 **Automated Test (Pest/PHPUnit)** untuk menguji pencegahan registrasi ganda pada email yang sama.

### Tahap 5: Pengujian, Finalisasi Kode & Dokumen
1. Lakukan pengujian manual secara menyeluruh (fitur pendaftaran, upload gambar, filter, dan login admin).
2. Jalankan automated test: `php artisan test`.
3. Buat file `README.md` pada akar repositori yang berisi:
   - Persyaratan versi PHP & Laravel
   - Cara instalasi & menjalankan seeder
   - Kredensial akun admin
   - Daftar template/library pihak ketiga yang digunakan
4. Export dokumen PRD / Analisis ini ke format **PDF**.

### Tahap 6: Recording Video Demo & Pengumpulan (Submission)
1. **Perekaman Video Demo (Maksimal 5 Menit):**
   - Tunjukkan alur pengunjung (pencarian, filter, pendaftaran kelas).
   - Tunjukkan alur admin (login, ringkasan dashboard, CRUD kelas & ubah status pendaftar).
   - Tunjukkan cuplikan kode penting (Migration, Relasi Eloquent, Enum, Unique Constraint).
2. Unggah Source Code ke **GitHub/GitLab** (pastikan visibilitas **Public**).
3. Unggah Dokumen PDF dan Video Demo ke **Google Drive** (pastikan akses **"Anyone with the link can view"**).
4. Isikan seluruh tautan ke Google Form pengumpulan sebelum tenggat waktu.