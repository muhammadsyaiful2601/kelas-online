<?php

namespace App;

use App\Enums\EnrollmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => EnrollmentStatus::class,
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}