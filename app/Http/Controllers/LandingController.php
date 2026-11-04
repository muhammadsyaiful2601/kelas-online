<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Enums\CourseStatus;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Mail\EnrollmentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    /**
     * Halaman katalog kelas publik (landing page).
     */
    public function index(Request $request)
    {
        $query = Course::with('category')->published();

        // Pencarian berdasarkan judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $courses = $query->latest()->paginate(9)->withQueryString();
        $categories = \App\Category::all();

        return view('landing.index', compact('courses', 'categories'));
    }

    /**
     * Halaman detail kelas + form pendaftaran.
     */
    public function show($slug)
    {
        $course = Course::with('category')->where('slug', $slug)->where('status', 'PUBLISHED')->firstOrFail();

        return view('landing.show', compact('course'));
    }

    /**
     * Proses pendaftaran kelas dari landing page.
     */
    public function storeEnrollment(StoreEnrollmentRequest $request, Course $course)
    {
        if ($course->status !== CourseStatus::PUBLISHED) {
            abort(404);
        }

        // Cek duplikasi pendaftaran (sama email pada kelas yang sama)
        $exists = Enrollment::where('course_id', $course->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'email' => 'Email ini sudah terdaftar untuk kelas ini.',
            ])->withInput();
        }

        $enrollment = $course->enrollments()->create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'status' => 'PENDING',
        ]);

        // Kirim email konfirmasi pendaftaran ke pendaftar
        Mail::to($request->email)->send(new EnrollmentConfirmation($course, $enrollment));

        return back()->with('success', 'Pendaftaran berhasil! Konfirmasi telah dikirim ke email Anda. Silakan tunggu verifikasi dari admin.');
    }
}
