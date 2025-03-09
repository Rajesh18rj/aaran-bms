<?php

namespace Aaran\Auth\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasPermission('edit_users');
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $this->user,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'sometimes|required|exists:roles,id'
        ];
    }
}
