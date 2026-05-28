<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'text' => 'required|min:12',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Dit veld is verplicht.',
            'name.min' => 'De titel moet ten minste 3 karakters bevatten.',
            'name.max' => 'De titel mag maximaal 255 karakters bevatten.',
            'text.required' => 'Dit veld is verplicht.',
            'text.min' => 'De tekst moet ten minste 12 karakters bevatten.'
        ];
    }
}
