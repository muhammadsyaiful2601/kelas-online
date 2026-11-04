<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'course_id' => 'required|exists:courses,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'course_id.required' => 'Kelas wajib dipilih.',
            'course_id.exists'  => 'Kelas yang dipilih tidak valid.',
        ];
    }
}
