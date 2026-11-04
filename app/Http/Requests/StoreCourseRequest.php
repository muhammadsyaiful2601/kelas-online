<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255|unique:courses,title',
            'slug'        => 'required|string|max:255|unique:courses,slug',
            'description' => 'required|string',
            'instructor'  => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'is_free'     => 'nullable|boolean',
            'image'       => 'nullable|image|max:2048',
            'status'      => 'required|in:DRAFT,PUBLISHED',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'title.required'       => 'Judul kelas wajib diisi.',
            'title.unique'         => 'Judul kelas sudah digunakan.',
            'slug.required'        => 'Slug kelas wajib diisi.',
            'slug.unique'          => 'Slug kelas sudah digunakan.',
            'description.required' => 'Deskripsi kelas wajib diisi.',
            'instructor.required'  => 'Instruktur wajib diisi.',
            'price.required'       => 'Harga kelas wajib diisi.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'price.min'            => 'Harga tidak boleh negatif.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2 MB.',
            'status.required'      => 'Status kelas wajib dipilih.',
            'status.in'            => 'Status kelas harus DRAFT atau PUBLISHED.',
        ];
    }
}
