# Website Kelas Online Sederhana

Sistem manajemen kelas online sederhana yang memungkinkan calon peserta melihat katalog kelas dan mendaftar, serta Dashboard Admin untuk mengelola katalog kelas, kategori, dan memverifikasi data pendaftar.

Dibangun dengan **Laravel 13**, **PHP 8.4**, **MySQL**, **Tailwind CSS**, dan **Blade**.

---

## Deskripsi Sistem

Platform web untuk lembaga pelatihan teknologi dengan dua peran pengguna:

### Pengunjung (Guest)
- Melihat landing page dan katalog kelas yang dipublikasikan (`PUBLISHED`)
- Mencari dan memfilter kelas berdasarkan judul/deskripsi maupun kategori
- Melihat detail kelas dan mengisi formulir pendaftaran (Nama, Email, No. HP)
- Tidak dapat mendaftar ganda dengan email yang sama pada kelas yang sama

### Admin
- Login/logout dengan autentikasi Laravel Breeze
- Dashboard ringkasan: total kelas, total pendaftar, dan 5 pendaftar terbaru
- CRUD kategori kelas dan CRUD kelas (termasuk upload gambar, status `DRAFT`/`PUBLISHED`)
- Kelola pendaftar: daftar per kelas dan update status (`PENDING`, `APPROVED`, `REJECTED`)
- Export data pendaftar ke **Excel (XLSX)**
- Kirim email konfirmasi pendaftaran otomatis ke peserta

---

## Cara Menjalankan

### 1. Clone Repositori

```bash
git clone https://github.com/muhammadsyaiful2601/kelas-online.git
cd kelas-online
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Salin Konfigurasi Environment

```bash
copy .env.example .env
```

> File `.env` **tidak di-commit** ke Git. Buat sendiri di komputer lokal.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env`, sesuaikan dengan database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=kelas_online
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `kelas_online` sudah dibuat di MySQL sebelum menjalankan migrasi.

### 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```

### 7. Storage Link (untuk gambar kelas)

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

Buka browser di `http://localhost:8000`.

### 9. Compile Asset Frontend (opsional, untuk production)

```bash
npm run build
```

---

## Kredensial Akun Admin Default

Setelah menjalankan `php artisan migrate --seed`:

| Field | Nilai |
|-------|-------|
| Email | `admin@gmail.com` |
| Password | `password` |

Login di halaman `/login`.

---

## Testing

Jalankan semua automated test:

```bash
php artisan test
```

---

## Persyaratan Sistem

| Komponen | Versi |
|----------|-------|
| PHP | 8.3 atau 8.4+ |
| Laravel | 13.x |
| Database | MySQL atau PostgreSQL |
| Composer | 2.x |
| Node.js / npm | Untuk compile asset Tailwind |
| Web Server | Apache / Nginx (atau `php artisan serve`) |

