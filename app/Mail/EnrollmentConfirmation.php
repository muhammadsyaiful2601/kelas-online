<?php

namespace App\Mail;

use App\Course;
use Illuminate\Mail\Mailable;

class EnrollmentConfirmation extends Mailable
{

    public $course;
    public $enrollment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course, $enrollment)
    {
        $this->course = $course;
        $this->enrollment = $enrollment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pendaftaran Kelas - ' . $this->course->title)
            ->view('emails.enrollment-confirmation')
            ->with([
                'course' => $this->course,
                'enrollment' => $this->enrollment,
            ]);
    }
}
