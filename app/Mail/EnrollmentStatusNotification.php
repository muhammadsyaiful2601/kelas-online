<?php

namespace App\Mail;

use App\Course;
use App\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $enrollment;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Enrollment $enrollment, Course $course, string $status)
    {
        $this->enrollment = $enrollment;
        $this->course = $course;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $statusLabel = match ($this->status) {
            'APPROVED' => 'Disetujui',
            'REJECTED' => 'Ditolak',
            default => 'Diperbarui',
        };

        return $this->subject('Konfirmasi Status Pendaftaran Kelas - ' . $this->course->title)
            ->view('emails.enrollment-status-notification')
            ->with([
                'course' => $this->course,
                'enrollment' => $this->enrollment,
                'status' => $this->status,
                'statusLabel' => $statusLabel,
            ]);
    }
}
