<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Extrae solo los IDs de las categorías
        $this->merge([
            'categories' => collect($this->categories)->pluck('id')->filter()->toArray(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'max:100',
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'content_uri' => ['nullable', 'string', 'max:255', 'url'],
            'pdf_uri' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'level_id' => ['required', 'integer', 'exists:levels,id'],
            'categories' => ['required', 'array'],
            'categories.*' => 'exists:categories,id',
        ];
    }
}
