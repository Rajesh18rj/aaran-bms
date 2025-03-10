<?php

namespace Aaran\Auth\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Implement authorization logic if needed
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
