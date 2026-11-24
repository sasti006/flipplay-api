<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|string|max:100',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi.',
            'title.unique' => 'Judul media sudah tersedia.',
            'type.required' => 'Jenis media wajib diisi.',
            'genre.required' => 'Genre media wajib diisi.',
            'release_year.required' => 'Tahun rilis wajib diisi.',
        ];
    }
}
