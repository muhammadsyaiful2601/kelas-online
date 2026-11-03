<?php

namespace Database\Seeders;

use App\Category;
use App\Course;
use App\Enums\CourseStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun admin default (kredensial: admin@gmail.com / password)
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Kategori dummy
        $categories = [
            [
                'name' => 'Pemrograman',
                'slug' => 'pemrograman',
                'description' => 'Kelas pemrograman dan pengembangan perangkat lunak.',
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
                'description' => 'Kelas desain grafis dan UI/UX.',
            ],
            [
                'name' => 'Bisnis',
                'slug' => 'bisnis',
                'description' => 'Kelas kewirausahaan dan manajemen bisnis.',
            ],
            [
                'name' => 'Bahasa',
                'slug' => 'bahasa',
                'description' => 'Kelas bahasa asing.',
            ],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }

        $categoryIds = Category::all()->pluck('id')->toArray();

        // Kelas dummy (campuran DRAFT dan PUBLISHED)
        $courses = [
            [
                'category_id' => $categoryIds[0] ?? 1,
                'title' => 'Pemrograman Web dengan Laravel 13',
                'slug' => 'pemrograman-web-laravel-13',
                'description' => 'Belajar membangun website modern dengan Laravel 13 dari nol hingga deployment.',
                'instructor' => 'Tim Pengajar',
                'price' => 150000,
                'is_free' => false,
                'image' => null,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $categoryIds[0] ?? 1,
                'title' => 'Dasar PHP untuk Pemula',
                'slug' => 'dasar-php-pemula',
                'description' => 'Pemrograman PHP dari nol, cocok untuk pemula yang ingin belajar backend.',
                'instructor' => 'Tim Pengajar',
                'price' => 0,
                'is_free' => true,
                'image' => null,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $categoryIds[1] ?? 2,
                'title' => 'Desain UI/UX dengan Figma',
                'slug' => 'desain-uiux-figma',
                'description' => 'Belajar merancang antarmuka pengguna yang nyaman dan menarik menggunakan Figma.',
                'instructor' => 'Tim Pengajar',
                'price' => 200000,
                'is_free' => false,
                'image' => null,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $categoryIds[2] ?? 3,
                'title' => 'Menjadi Freelancer Handal',
                'slug' => 'menjadi-freelancer-handal',
                'description' => 'Strategi memulai karir freelancer dan mendapatkan klien pertama.',
                'instructor' => 'Tim Pengajar',
                'price' => 120000,
                'is_free' => false,
                'image' => null,
                'status' => CourseStatus::DRAFT,
            ],
        ];

        foreach ($courses as $data) {
            Course::create($data);
        }
    }
}
