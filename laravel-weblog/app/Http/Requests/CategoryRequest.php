<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'newCategory' => 'required|min:3|max:12',
        ];
    }

    public function messages(): array
    {
        return [
            'newCategory.required' => 'Dit veld is verplicht.',
            'newCategory.min' => 'Dit veld moet ten minste 3 karakters bevatten.',
            'newCategory.max' => 'Dit veld mag maximaal 12 karakters bevatten.',
        ];
    }
}
