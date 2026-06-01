<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'newComment' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'newComment.required' => 'Dit veld is verplicht.',
            'newComment.max' => 'De reactie mag maximaal 255 karakters bevatten.',
        ];
    }
}
