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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    /**
     * Ekspor data pendaftar ke Excel (terapkan filter yang sama dengan index).
     */
    public function export(Request $request)
    {
        $query = Enrollment::with('course');

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $enrollments = $query->latest()->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pendaftar');
        $headers = ['No', 'Kelas', 'Nama', 'Email', 'Telepon', 'Status', 'Tanggal Pendaftaran'];
        $sheet->fromArray($headers, null, 'A1');

        foreach ($enrollments as $index => $enrollment) {
            $sheet->fromArray([
                $index + 1,
                $enrollment->course->title,
                $enrollment->name,
                $enrollment->email,
                $enrollment->phone ?? '-',
                ucfirst(strtolower($enrollment->status->value)),
                $enrollment->created_at->format('d M Y H:i'),
            ], null, 'A' . ($index + 2));
        }

        $lastRow = count($enrollments) + 1;
        $lastColumn = 'G';
        $tableRange = "A1:{$lastColumn}{$lastRow}";

        $sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('E2E8F0');
        $sheet->freezePane('A2');
        $sheet->setAutoFilter($tableRange);

        foreach (['A' => 8, 'B' => 32, 'C' => 24, 'D' => 34, 'E' => 18, 'F' => 14, 'G' => 24] as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $filename = 'pendaftar-' . now()->format('Ymd_His') . '.xlsx';

        ob_start();
        (new Xlsx($spreadsheet))->save('php://output');
        $content = ob_get_clean();

        return response($content)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
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
