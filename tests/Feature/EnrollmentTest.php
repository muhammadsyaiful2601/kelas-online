<?php

namespace Tests\Feature;

use App\Category;
use App\Course;
use App\Enrollment;
use App\Enums\CourseStatus;
use App\Enums\EnrollmentStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_pendaftaran_baru_berhasil_dibuat(): void
    {
        $category = Category::create(['name' => 'Pemrograman', 'slug' => 'pemrograman']);
        $course = $this->buatCourse($category, 'Belajar Laravel', 'belajar-laravel');

        $response = $this->post(route('landing.enroll', $course), [
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'course_id' => $course->id,
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('enrollments', [
            'course_id' => $course->id,
            'email' => 'andi@example.com',
            'name' => 'Andi Saputra',
            'status' => EnrollmentStatus::PENDING->value,
        ]);
    }

    public function test_pendaftaran_ganda_dengan_email_sama_di_kelas_sama_ditolak(): void
    {
        $category = Category::create(['name' => 'Pemrograman', 'slug' => 'pemrograman']);
        $course = $this->buatCourse($category, 'Belajar Laravel', 'belajar-laravel');

        // Pendaftaran pertama berhasil.
        $this->post(route('landing.enroll', $course), [
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'course_id' => $course->id,
        ]);

        $this->assertDatabaseCount('enrollments', 1);

        // Pendaftaran kedua dengan email yang sama di kelas yang sama harus ditolak.
        $response = $this->post(route('landing.enroll', $course), [
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'course_id' => $course->id,
        ]);

        $response->assertSessionHasErrors('email');
        $response->assertRedirect();
        $response->assertSessionMissing('success');

        $this->assertDatabaseCount('enrollments', 1);
    }

    public function test_sama_email_boleh_mendaftar_kelas_berbeda(): void
    {
        $category = Category::create(['name' => 'Pemrograman', 'slug' => 'pemrograman']);

        $courseLaravel = $this->buatCourse($category, 'Belajar Laravel', 'belajar-laravel');
        $courseReact = $this->buatCourse($category, 'Belajar React', 'belajar-react');

        $this->post(route('landing.enroll', $courseLaravel), [
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'course_id' => $courseLaravel->id,
        ]);

        $response = $this->post(route('landing.enroll', $courseReact), [
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'course_id' => $courseReact->id,
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        $this->assertDatabaseCount('enrollments', 2);
    }

    public function test_export_pendaftar_menghasilkan_excel_dengan_nomor_kolom_dan_garis_tabel(): void
    {
        $category = Category::create(['name' => 'Pemrograman', 'slug' => 'pemrograman']);
        $course = $this->buatCourse($category, 'Belajar Laravel', 'belajar-laravel');
        Enrollment::create([
            'course_id' => $course->id,
            'name' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'phone' => '081234567890',
            'status' => EnrollmentStatus::PENDING,
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('admin.enrollments.export'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $path = tempnam(sys_get_temp_dir(), 'pendaftar-');
        file_put_contents($path, $response->getContent());
        $sheet = IOFactory::load($path)->getActiveSheet();

        $this->assertSame('No', $sheet->getCell('A1')->getValue());
        $this->assertSame('Tanggal Pendaftaran', $sheet->getCell('G1')->getValue());
        $this->assertSame(1, $sheet->getCell('A2')->getValue());
        $this->assertSame('Andi Saputra', $sheet->getCell('C2')->getValue());
        $this->assertSame('thin', $sheet->getStyle('A1')->getBorders()->getLeft()->getBorderStyle());

        unlink($path);
    }

    private function buatCourse(Category $category, string $title, string $slug): Course
    {
        return Course::create([
            'category_id' => $category->id,
            'title' => $title,
            'slug' => $slug,
            'description' => 'Kursus ' . $title . ' untuk pemula.',
            'instructor' => 'Tim Pengajar',
            'price' => 150000,
            'is_free' => false,
            'status' => CourseStatus::PUBLISHED,
        ]);
    }
}
