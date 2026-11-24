<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $media = $this->route('medium');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($media),
            ],
            'type' => 'required|string|max:100',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
        ];
    }
}
