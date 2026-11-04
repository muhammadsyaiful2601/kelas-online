<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('category');

        return [
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug'        => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Nama kategori wajib diisi.',
            'name.unique'      => 'Nama kategori sudah digunakan.',
            'slug.required'    => 'Slug kategori wajib diisi.',
            'slug.unique'      => 'Slug kategori sudah digunakan.',
        ];
    }
}
