<?php

namespace App\Mail;

use App\Enrollment;
use App\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentAdminClarification extends Mailable
{
    use Queueable, SerializesModels;

    public $enrollment;
    public $course;
    public $previousStatus;
    public $newStatus;
    public $adminName;

    public function __construct(Enrollment $enrollment, Course $course, string $previousStatus, string $newStatus, string $adminName)
    {
        $this->enrollment = $enrollment;
        $this->course = $course;
        $this->previousStatus = $previousStatus;
        $this->newStatus = $newStatus;
        $this->adminName = $adminName;
    }

    public function build()
    {
        return $this->subject('Klarifikasi: Perubahan Status Pendaftaran oleh Admin')
            ->view('emails.enrollment-admin-clarification');
    }
}