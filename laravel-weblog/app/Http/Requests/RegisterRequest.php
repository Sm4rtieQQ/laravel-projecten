<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Dit veld is verplicht.',
            'name.min' => 'Dit veld moet ten minste 3 karakters bevatten.',
            'name.max' => 'Dit veld mag maximaal 20 karakters bevatten.',
            'email.required' => 'Dit veld is verplicht.',
            'email.email' => 'A.u.b. een geldig email adres invoeren.',
            'email.unique' => 'Email adres is al in gebruik.',
            'password.required' => 'Dit veld is verplicht.',
            'password.min' => 'Dit veld moet ten minste 6 karakters bevatten.',
            'password.max' => 'Dit veld mag maximaal 20 karakters bevatten.',
            'password.confirmed' => 'De wachtwoorden komen niet overeen.',
            'password_confirmation.required' => 'Dit veld is verplicht.',
        ];
    }
}
