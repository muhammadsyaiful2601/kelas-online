<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:PENDING,APPROVED,REJECTED',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status pendaftaran wajib dipilih.',
            'status.in'       => 'Status pendaftaran harus PENDING, APPROVED, atau REJECTED.',
        ];
    }
}
