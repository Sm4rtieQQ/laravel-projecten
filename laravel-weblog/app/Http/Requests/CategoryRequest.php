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
            'name' => 'required|min:3|max:12',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Dit veld is verplicht.',
            'name.min' => 'Dit veld moet ten minste 3 karakters bevatten.',
            'name.max' => 'Dit veld mag maximaal 12 karakters bevatten.',
        ];
    }
}
