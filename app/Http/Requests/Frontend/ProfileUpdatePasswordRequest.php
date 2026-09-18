<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string', 'min:5'],
            'password' => ['required', 'string', 'min:5', 'confirmed']
        ];
    }


    public function messages(): array
    {
        return [
            'current_password.required' => 'Please enter your current password.',
            'current_password.min' => 'Current password must be at least 5 characters.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'New password must be at least 5 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
