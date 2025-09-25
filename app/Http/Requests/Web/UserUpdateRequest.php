<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'hobbies'   => 'array',
            'hobbies.*' => 'nullable|string|max:100'
        ];
    }
}
