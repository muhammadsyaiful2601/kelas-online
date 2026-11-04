<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEnrollmentStatusRequest;
use App\Course;
use App\Enrollment;
use App\Enums\EnrollmentStatus;
use App\Mail\EnrollmentAdminClarification;
use App\Mail\EnrollmentStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with('course');

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $enrollments = $query->latest()->paginate(10);
        $courses = Course::all();
        $statuses = ['PENDING', 'APPROVED', 'REJECTED'];

        return view('admin.enrollments.index', compact('enrollments', 'courses', 'statuses'));
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load('course');

        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function update(UpdateEnrollmentStatusRequest $request, Enrollment $enrollment)
    {
        $previousStatus = $enrollment->status->value;
        $newStatus = $request->status;

        $enrollment->update([
            'status' => $newStatus,
        ]);

        $admin = Auth::user();
        $adminName = $admin ? $admin->name : 'Admin';
        $adminEmail = $admin ? $admin->email : config('mail.from.address');

        // Kirim email konfirmasi ke pendaftar jika status berubah
        if ($previousStatus !== $newStatus) {
            $course = $enrollment->course;
            Mail::to($enrollment->email)->send(new EnrollmentStatusNotification($enrollment, $course, $newStatus));

            // Kirim email klarifikasi ke admin untuk setiap perubahan status
            if ($previousStatus !== $newStatus) {
                Mail::to($adminEmail)->send(new EnrollmentAdminClarification($enrollment, $course, $previousStatus, $newStatus, $adminName));
            }
        }

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
