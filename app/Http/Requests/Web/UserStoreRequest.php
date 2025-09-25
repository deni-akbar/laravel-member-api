<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // bisa diatur sesuai policy
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'hobbies'   => 'array',
            'hobbies.*' => 'nullable|string|max:100'
        ];
    }
}
