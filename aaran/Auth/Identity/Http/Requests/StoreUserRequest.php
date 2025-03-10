<?php

namespace Aaran\Auth\Identity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('create_users');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // Custom profile photo support
            'tenant_id' => ['nullable', 'exists:tenants,id'], // Future tenant-based functionality
        ];
    }
}
